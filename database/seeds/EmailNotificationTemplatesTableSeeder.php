<?php

use Illuminate\Database\Seeder;

class EmailNotificationTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Reservation confirmation',
                'email_body' => '',
                'notify_event' => 'NewReservationCustomer'
            ],
            [
                'name' => 'Reservation confirmation',
                'email_body' => '',
                'notify_event' => 'NewReservationAdmin'
            ],
            [
                'name' => 'Payment confirmation',
                'email_body' => '',
                'notify_event' => 'PaymentConfirmationCustomer'
            ],
            [
                'name' => 'Payment confirmation',
                'email_body' => '',
                'notify_event' => 'PaymentConfirmationAdmin'
            ],
            [
                'name' => 'Cancellation Email',
                'email_body' => '',
                'notify_event' => 'CancellationEmailCustomer'
            ],
            [
                'name' => 'Cancellation Email',
                'email_body' => '',
                'notify_event' => 'CancellationEmailAdmin'
            ],
            
        ];

        DB::table('email_notification_templates')->insert($users);
    }
}
