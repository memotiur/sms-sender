<?php

namespace App\Http\Controllers;


use App\Credit;
use App\Recharge;
use App\SmsTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SoapClient;


class AdminController extends Controller
{

    public function home(Request $request)
    {
        $result = Credit::where('user_id', Session::get('id'))->first();
        return view('pages.home.index')->with('result', $result);


    }

    public function sendToSingle(Request $request)
    {
        if ($request->isMethod('post')) {
            $phones = $request['phone'];
            $message = $request['message'];
            $name = "";

            $this->sentMessage($name, $phones, $message);

            return back()->with('success', "1");
        } else {
            return view('pages.sms.single_sms');
        }


    }

    public function sendToMany(Request $request)
    {

        if ($request->isMethod('post')) {
            $phones = $request['phone'];
            $phones = str_replace(' ', '', $phones);
            $message = $request['message'];

            $phone = explode(',', $phones);
            $counter = 1;
            $name = "";

            foreach ($phone as $item) {

                $this->sentMessage($name, $item, $message);
                $counter++;
            }

            return back()->with('success', $counter);
        } else {
            return view('pages.sms.multiple_sms');
        }


    }

    public function sendSms(Request $request)
    {
        if ($request->isMethod('post')) {
            $message = $request['message'];
            if ($request->hasFile('file')) {

                $path = $request->file('file')->getRealPath();

                /* try {
                     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                     $spreadsheet = $reader->load($path);
                     return print_r($spreadsheet);
                 } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                 }*/

                try {
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);

                    $worksheet = $spreadsheet->getActiveSheet();

                    $maxCell = $worksheet->getHighestRowAndColumn();
                    //return $maxCell['column'] .' : '. $maxCell['row'];

                    /*  $highestRow = $worksheet->getHighestRowWhereCellExistsAndIsNonBlank();
                      $highestRow = $worksheet->getHighestDataRow();
                      $highestCol = $worksheet->getHighestDataColumn();

                      return $highestRow . ' : '. $highestCol;*/

                    $worksheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
                    //return $data = $worksheet->rangeToArray('A1:' . $highestColumn . $highestRow, null, true, false, false);

                    $rows = [];
                    $counter = 1;
                    foreach ($worksheet->getRowIterator() AS $row) {
                        $counter++;
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                        $cells = [];
                        foreach ($cellIterator as $cell) {
                            $cells[] = $cell->getValue();
                        }
                        $rows[] = $cells;
                        if ($cells[1] == null) {
                            break;
                        } else {
                            $this->sentMessage($cells[0], '0' . $cells[1], $message);
                        }
                        $counter++;
                    }

                } catch (\Exception $e) {
                }

                return back()->with('success', $counter);

            }
        } else {
            return view('pages.sms.index');
        }

    }

    public function statistics(Request $request)
    {
         $result = SmsTrack::orderBy('sms_id', 'DESC')->get();
        return view('pages.sms.statistics')->with('result', $result);
    }

    private function sentMessage($name, $phone, $message)
    {
        $result = Credit::where('user_id', Session::get('id'))->first();
        $notes = "Successfuly Message Sent";
        if ($result->account_balance < 1) {
            $status = 0;
            $notes = "Insufficient Account Balance";
        } else {
            $status = 1;
            //TODO:: Execute Message sent Code
            if ($name != "") {
                $message = $name . ", " . $message;
            }
            if (substr($phone, 0, 1) != '0') {
                $phone = "0" . $phone;
            }
            /* try {
                 $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
                 $paramArray = array(
                     'userName' => "01717849968",
                     'userPassword' => "3f718e",
                     'mobileNumber' => $phone,
                     'smsText' => $message,
                     'type' => "TEXT",
                     'maskName' => '',
                     'campaignName' => '',
                 );
                 $value = $soapClient->__call("OneToOne", array($paramArray));
                 echo $value->OneToOneResult;
             } catch (Exception $e) {
                 echo $e->getMessage();
             }*/
        }


        if ($status == 1) {
            $message_counter = 1;
            $message_price = 1;
            $message_sent_status = true;
            $message_sent_notes = $notes;
            $message_delivery_report = false;
            $this->saveIntoDb($name, $phone, $message, $message_counter, $message_price, $message_sent_status, $message_sent_notes, $message_delivery_report, $result->account_balance);
        } else {
            $message_counter = 1;
            $message_price = 0;
            $message_sent_status = false;
            $message_sent_notes = $notes;
            $message_delivery_report = false;
            $this->saveIntoDb($name, $phone, $message, $message_counter, $message_price, $message_sent_status, $message_sent_notes, $message_delivery_report, $result->account_balance);

        }

        return 1;

    }

    private function saveIntoDb($name, $phone, $message, $message_counter, $message_price, $message_sent_status, $message_sent_notes, $message_delivery_report, $account_balance)
    {
        $user_id = Session::get('id');
        $array = array(
            'user_id' => $user_id,
            'name' => $name,
            'phone' => $phone,
            'message' => $message,
            'message_counter' => $message_counter,
            'message_price' => $message_price,
            'message_sent_status' => $message_sent_status,
            'message_sent_notes' => $message_sent_notes,
            'message_delivery_report' => $message_delivery_report,
        );
        try {
            SmsTrack::create($array);
        } catch (\Exception $exception) {

        }

        if ($message_sent_status == true) {
            Credit::where('user_id', $user_id)->update([
                'account_balance' => $account_balance - $message_price
            ]);
        }

    }

}
