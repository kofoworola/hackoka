<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\AfricasTalkingGateway;

class RequestAppointment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $appointment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $patient = \App\User::find($this->appointment->patient_id);
        $doctor = \App\User::find($this->appointment->doctor_id);

        $username = 'sandbox';
        $apiKey = "9cb7b64fbe309fcaa7d310dcba6a5ce6056d699b18a6e00b235a4e5c16501ab3";

        $recipients = $doctor->phone;

        $message    = "Your patient ".$patient->fname ." ".$patient->lname[0]. " has requested an appointment at ".$this->appointment->start_date->toDateTimeString()." to ".$this->appointment->end_date->toDateTimeString()." reply YES-".$this->appointment->id." to confirm and NO-".$this->appointment->id." to deny" ;

        $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");

        try { 
        // Thats it, hit send and we'll take care of the rest. 
            $results = $gateway->sendMessage($recipients, $message);
                    
            foreach($results as $result) {
                    // status is either "Success" or "error message"
                    echo " Number: " .$result->number;
                    echo " Status: " .$result->status;
                    echo " MessageId: " .$result->messageId;
                    echo " Cost: "   .$result->cost."\n";
                }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
                echo "Encountered an error while sending: ".$e->getMessage();
            }
    }
}
