<?php

namespace App\Services;

class RazorpayService
{
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->apiKey = env('RAZORPAY_KEY');
        $this->apiSecret = env('RAZORPAY_SECRET');
    }

    // Send cURL request to Razorpay API
    private function sendRequest($endpoint, $data, $method = 'POST')
    {
        $url = "https://api.razorpay.com/v1/{$endpoint}";
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "{$this->apiKey}:{$this->apiSecret}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception('Razorpay API Error: ' . curl_error($curl));
        }

        curl_close($curl);
        return json_decode($response, true);
    }

    // Create Contact
    public function createContact($name, $email, $contact, $type = 'vendor', $referenceId = null)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
            'type' => $type,
            'reference_id' => $referenceId,
        ];

        return $this->sendRequest('contacts', $data);
    }

    // Create Fund Account
    public function createFundAccount($contactId, $accountHolderName, $accountNumber, $ifsc)
    {
        $data = [
            'contact_id' => $contactId,
            'account_type' => 'bank_account',
            'bank_account' => [
                'name' => $accountHolderName,
                'account_number' => $accountNumber,
                'ifsc' => $ifsc
            ]
        ];

        return $this->sendRequest('fund_accounts', $data);
    }

    // Create Payout
    public function createPayout($account_number, $fundAccountId, $amount, $currency = 'INR', $mode = 'IMPS')
    {

        $data = [
            'account_number' => $account_number, // Razorpay's internal account number
            'fund_account_id' => $fundAccountId,
            'amount' => $amount * 100, // Convert to paise (1 INR = 100 paise)
            'currency' => $currency,
            'mode' => $mode,
            'purpose' => 'payout',
            'queue_if_low_balance' => true,
        ];

        return $this->sendRequest('payouts', $data);
    }

    // Approve Payout
    public function approvePayout($payoutId)
    {
        // Replace the payout ID and pass it to the endpoint
        $endpoint = "payouts/$payoutId/approve";

        $data = [
            'remarks' => 'Accepting Payout Payment',

        ];

        return $this->sendRequest($endpoint, $data);
    }
}
