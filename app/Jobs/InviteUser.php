<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\AfricasTalkingGateway;

class InviteUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $password;
    private $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$password,$type)
    {
        $this->user = $user;
        $this->password = $password;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $username = 'sandbox';
        $apiKey = "9cb7b64fbe309fcaa7d310dcba6a5ce6056d699b18a6e00b235a4e5c16501ab3";

        $recipients = "+234".$this->user->phone;

        $message    = "A ".$this->type." Account has been created for you on ".$this->user->hospital->name. ".Login at ".route('dashboard',['domain'=> $this->user->hospital->slug]). " with ".$this->user->email. "and ".$this->password;

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

                if($this->type == 'patient'){
                     $message    = "Your patient id is ".$this->user->patient_id;

                    $results = $gateway->sendMessage($recipients, $message);
                    
                    foreach($results as $result) {
                        // status is either "Success" or "error message"
                        echo " Number: " .$result->number;
                        echo " Status: " .$result->status;
                        echo " MessageId: " .$result->messageId;
                        echo " Cost: "   .$result->cost."\n";
                    }
                }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
                echo "Encountered an error while sending: ".$e->getMessage();
            }

        }
}
