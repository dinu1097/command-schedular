<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Commands;
use App\Mail\MailAllFlights;


class CommandController extends Controller
{
    public function create()
    {
        return view('index');
    }
    public function store(Request $request)
    {
        Commands::create($request->post());

        return $this->show();
    }

    public function show()
    {
        $commands = Commands::all(); // Assuming you have an Eloquent model named Commands
        return view('running-commands', compact('commands'));
    }

    public function delete($id)
    {
        $flight = Commands::find($id);
        $flight->delete();
        return $this->show(); 
    }

    public function shootApiAndEmail()
    {
        $allCommands = Commands::all();

        // $allCommandsArray = $allCommands->toArray();
        
        foreach($allCommands as $commandRow)
        {
            // $commandRow->departureTime = date('yyyy-MM-ddTHH:mm:ss', strtotime($commandRow->departureTime));
            // $commandRow->arrivalTime = date('yyyy-MM-ddTHH:mm:ss', strtotime($commandRow->arrivalTime));
            // dd($commandRow->arrivalTime);

            $jsonData = '{
                "EndUserIp": "192.168.0.106",
                "TokenId": "2e123811-c8c4-4341-8301-a864b04a19a8",
                "AdultCount": "1",
                "ChildCount": "0",
                "InfantCount": "0",
                "DirectFlight": "false",
                "OneStopFlight": "false",
                "JourneyType": "4",
                "PreferredAirlines": ["'.$commandRow->airline.'"],
                "Segments": [
                    {
                        "Origin": "'.$commandRow->flyingFrom.'",
                        "Destination": "'.$commandRow->flyingTo.'",
                        "FlightCabinClass": "'.$commandRow->class.'",
                        "PreferredDepartureTime": "'.$commandRow->departureTime.'",
                        "PreferredArrivalTime": "'.$commandRow->arrivalTime.'"
                    }
                ],
                "Sources": ["GDS"]
            }
            ';
            $searchResponse = $this->sendApiRequest($jsonData);
            $errorCode = $searchResponse['Response']['Error']['ErrorCode'];
            $errorMessage = $searchResponse['Response']['Error']['ErrorMessage'];
            // $welcome = $searchResponse['Response']['Results'][0][0]['Segments'];
            // dd($searchResponse);
            $flightResults = $searchResponse['Response']['Results'][0];
            // dd($errorMessage);
            // dd($flightResults);
            foreach($flightResults as $flight)
            {
                $segments = $flight['Segments'][0];
                // dd($segments);
                foreach($segments as $subFlightData)
                {
                    $flightNumber = $subFlightData['Airline']['FlightNumber'];
                    $availability = $subFlightData['Availability'];
                    // dd($availability); 
                    foreach($availability as $availabilityData)
                    {
                        $subClass = $commandRow->subclass;
                        if($availabilityData['Class'] == $subClass AND $availabilityData['Seats'] > 0)
                        {
                            $commandRow->errorMessage = $errorMessage;
                            $commandRow->subClass = $subClass;
                            $commandRow->seats = $availabilityData['Seats'];
                            $commandRow->flightNumber = $flightNumber;
                            if($errorCode != "25")
                            {
                                $this->sendEmail('dinnis067@gmail.com', $commandRow);
                                goto endLoop;        
                            }
                        }
                        // $subFlightAvailability['Availability'];
                    }  
                }
            }
            endLoop:
            // $TraceId = $searchResponse['Response']['TraceId'];

            // $jsonDataFlightDetails = '{
            //     "AdultCount": "1",
            //     "ChildCount": "1",
            //     "InfantCount": "1",
            //     "EndUserIp": "192.168.10.130",
            //     "TokenId": "5e1489d9-d318-4beb-86d4-eb50863e50f9",
            //     "TraceId": "'.$TraceId.'",
            //     "AirSearchResult": [
            //     {
            //     "ResultIndex": "OB1",
            //     "Source": 4,
            //     "IsLCC": false,
            //     "IsRefundable": true,
            //     "AirlineRemark": "",
            //     "Segments": [
            //     [
            //     {
            //     "TripIndicator": 1,
            //     "SegmentIndicator": 1,
            //     "Airline": {
            //     "AirlineCode": "AI",
            //             "AirlineName": "Air India",
            //     "FlightNumber": "349",
            //     "FareClass": "F",
            //     "OperatingCarrier": ""
            //     }
            //     }
            //     ]
            //     ]
            //     }
            //             ]
            //     }';

            // $searchResponseFlightDetails = $this->sendApiRequestGetFlightDetails($jsonDataFlightDetails);
            // dd($searchResponseFlightDetails);
            // $this->sendEmail('dinnis067@gmail.com', $flights);
        }


        // // Send the API request with the filtered data

        // // Send the email to dinnis067@gmail.com
    }

    private function sendApiRequest($requestData)
    {

        
        // Make the POST request using Laravel's HTTP Client
        $response = Http::post('http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search', json_decode($requestData, true));
        
        // Get the response data
        $result = $response->json();
        
        // You can now handle the $result as needed
        // For example, you can check the status code and response data
        $status = $response->status();
        if ($status === 200) {
            // Success
            return $result;
        } else {
            return $status;
        }
    
    }

    private function sendApiRequestGetFlightDetails($requestData)
    {

        
        // Make the POST request using Laravel's HTTP Client
        $response = Http::post('http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/PriceRBD', json_decode($requestData, true));
        
        // Get the response data
        $result = $response->json();
        
        // You can now handle the $result as needed
        // For example, you can check the status code and response data
        $status = $response->status();
        if ($status === 200) {
            // Success
            return $result;
        } else {
            return $status;
        }
    
    }


    public function sendEmail($recipent,$flights)
    {
        $recipient = 'dinnis067@gmail.com';

    
        Mail::to($recipient)->send(new MailAllFlights($flights));
    }
}
