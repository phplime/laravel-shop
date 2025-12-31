<?php

namespace App\Data;

class EmailTemplates
{
    public static $defaultTemplates = [
        "recovery_mail" => [
            "subject" => [
                "en" => "Password Recovery Mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">A Recovery mail from {SITE_NAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Hello {USERNAME}, Use this&nbsp;<span style=\"font-weight: 700;\">{PASSWORD} password to login.</span></p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\"><span style=\"font-weight: 700;\">Please don't share this password with anyone.</span></p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\"><span style=\"font-weight: 700;\">Thank you!</span></p><div><span style=\"font-weight: 700;\"><br></span></div>"
            ]
        ],
        "contact_mail" => [
            "subject" => [
                "en" => "Contact Mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Contact Mail from {NAME} on {SITE_NAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Name: {NAME}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Email: {EMAIL}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Message: {MESSAGE}</p>"
            ]
        ],
        "resend_verify_mail" => [
            "subject" => [
                "en" => "Resend Verification Mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px;\">Account Verification Mail from {SITE_NAME},</p><p style=\"margin-bottom: 10px;\">Hello {USERNAME}</p><p style=\"margin-bottom: 10px;\">Click&nbsp;verify link to verify your account {LINK}</p><p style=\"margin-bottom: 10px;\"><br></p>"
            ]
        ],
        "email_verification_mail" => [
            "subject" => [
                "en" => "Account Verification Mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px;\"><span style=\"font-weight: 700;\">Account</span>&nbsp;Verification Mail From {SITE_NAME},</p><p style=\"margin-bottom: 10px;\">Congratulations {USERNAME},</p><p style=\"margin-bottom: 10px;\">Name: {USERNAME}</p><p style=\"margin-bottom: 10px;\">Email: {EMAIL}</p><p style=\"margin-bottom: 10px;\">Package: {PACKAGE_NAME}</p><p style=\"margin-bottom: 10px;\">Password: {PASSWORD}</p><p style=\"margin-bottom: 10px;\">Click / Copy the verification link {VERIFY_LINK}</p><p style=\"margin-bottom: 10px;\">Thank you!</p><p style=\"margin-bottom: 10px;\"><br></p>"
            ]
        ],
        "payment_confirmation_mail" => [
            "subject" => [
                "en" => "Payment Invoice"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Payment Invoice {SITE_NAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Name: {USERNAME}&nbsp;</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Email: {EMAIL}&nbsp;</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Payment method: {PAYMENT_METHOD}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Payment Date: {PAYMENT_DATE}&nbsp;</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Txn ID: {TXNID}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\"><br></p><table class=\"table table-bordered\" style=\"border-spacing: 0px; background-color: rgba(255, 255, 255, 0.1); width: 468.656px; max-width: 100%; margin-bottom: 20px; border: 1px solid var(--border-color); color: rgb(194, 199, 208); font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\"><tbody><tr><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">#</td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">Description<br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">Package name<br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">Qty<br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">Price<br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">Total<br></td></tr><tr><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">1</td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><p style=\"margin-bottom: 10px;\">Your payment has been completed successfully.</p><p style=\"margin-bottom: 10px;\">Your account will be expired on {EXPIRE_DATE}</p></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><p style=\"margin-bottom: 10px;\">{PACKAGE_NAME}<br></p></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">1</td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">{PRICE}</td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">{PRICE} USD<br></td></tr><tr><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\"><br></td><td style=\"padding: 8px; line-height: 1.42857; border: 1px solid var(--border-color);\">{PRICE} /=<p style=\"margin-bottom: 10px;\"><br></p></td></tr></tbody></table>"
            ]
        ],
        "expire_reminder_mail" => [
            "subject" => [
                "en" => "Account Expire reminder mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">An&nbsp;Account Expire reminder from&nbsp;{SITE_NAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Name: {USERNAME}&nbsp;&nbsp;&nbsp;Email: {EMAIL}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Expire date: {EXPIRE_DATE}&nbsp;Day left: {REMAINING_DAYS}</p>"
            ]
        ],
        "account_expire_mail" => [
            "subject" => [
                "en" => "Account Expired Mail"
            ],
            "message" => [
                "en" => "<p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">An Account Expire reminder from {SITE_NAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Hello {USERNAME},</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Your account already expired on {EXPIRE_DATE}</p><p style=\"margin-bottom: 10px; font-family: -apple-system, 'system-ui', 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 14px;\">Email: {EMAIL}</p>"
            ]
        ]
    ];


    public static function mailType($type = '')
    {
        $mailType = [
            'recovery_mail' => ['SITE_NAME', 'USERNAME', 'PASSWORD'],
            'contact_mail' => ['SITE_NAME', 'NAME', 'EMAIL', 'MESSAGE'],
            'resend_verify_mail' => ['SITE_NAME', 'USERNAME', 'LINK'],
            'email_verification_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PASSWORD', 'PACKAGE_NAME', 'VERIFY_LINK'],
            'account_create_invoice' => ['SITE_NAME', 'USERNAME', 'PACKAGE_NAME', 'PRICE'],
            'new_user_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PACKAGE_NAME'],
            'offline_payment_request_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PACKAGE_NAME', 'PRICE', 'TXNID'],
            // 'new_user_create_mail_by_author'=>['SITE_NAME','USERNAME','EMAIL','PACKAGE_NAME','PASSWORD'],
            'send_payment_verified_email' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PAYMENT_METHOD', 'PAYMENT_DATE', 'TXNID', 'EXPIRE_DATE', 'PACKAGE_NAME', 'PRICE'],
            'expire_reminder_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'EXPIRE_DATE', 'REMAINING_DAYS'],
            'account_expire_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'EXPIRE_DATE'],
        ];
        if ($type == '') {
            return $mailType;
        } else {
            return !empty($mailType[$type]) ? $mailType[$type] : '';
        }
    }


    public static function install()
    {
        $jsonString = json_encode(self::$defaultTemplates, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // Check if config already exists
        $exists = \App\Models\Settings::where('key', 'email_template_config')->exists();

        if (!$exists) {
            // Insert only if not exists
            \App\Models\Settings::create([
                'key' => 'email_template_config',
                'value' => $jsonString
            ]);

            __updateCacheValue('email_template_config', $jsonString);
        }
    }
}
