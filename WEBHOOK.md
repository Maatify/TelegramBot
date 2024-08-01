
## Webhook
### Instance
```php
$webhook = $telegram->Webhook();
```

### setWebhook
```php
$webhook->OptionsSetter()
->SetIp('1.1.1.1');                                 // Optional The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
->SetMaxConnections(1);                             // Optional The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
->SetSecretToken(__YOUR_WEBHOOK_SECRET_KEY__);      // Optional A secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook set by you.

$set = $webhook->SetWebhook(__YOUR_WEBHOOK_URL__);  // Set Webhook

print_r($set);
```
### webhookInfo
```php
$info = $webhook->WebhookInfo();    // get Webhook Info

print_r($info);
```

### deleteWebhook
```php
$info = $webhook->DeleteWebhook();    // delete current Webhook

print_r($info);
```


### Webhook update reader
#### create php file for webhook url

```php
<?php

use Maatify\TelegramBot\Webhook\WebhookUpdate;

require __DIR__ . '/vendor/autoload.php';

$update = (new WebhookUpdate())->update();
$full_message = $update->GetMessage();

// ================== return all of message ==================
$update_id          = $update->UpdateID();      // get Message Update ID  (int)
$message_id         = $update->GetMessageID();  // get Message ID  (int)
$message_array      = $update->GetMessage();    // get message array (array)
$from_array         = $update->GetFrom();       // get message from array (array)
$chat_array         = $update->GetChat();       // get message chat array (array)
$text               = $update->GetText();       // get message text (string)
$date               = $update->GetDate();       // get message Date as timestamp (int)

// ================== return from (sender info) of message ==================
$from_obj           = $update->From();
$from_id            = $from_obj->ID();           // get sender id from message array (int)
$from_is_bot        = $from_obj->IsBot();        // get sender is_bot from message array (bool)
$from_first_name    = $from_obj->FirstName();    // get sender first_name from message array (string)
$from_last_name     = $from_obj->LastName();     // get sender last_name from message array (string)
$from_username      = $from_obj->Username();     // get sender username from message array (string)
$from_language_code = $from_obj->LanguageCode(); // get sender language_code from message array (string)

// ================== return chat (chat info) of message ==================
$chat_obj           = $update->Chat();
$chat_array         = $update->GetChat();      // get chat from array (array)
$chat_id            = $chat_obj->ID();         // get chat id from array (int)
$chat_first_name    = $chat_obj->FirstName();  // get chat first_name from array (string)
$chat_last_name     = $chat_obj->LastName();   // get chat last_name from array (string)
$chat_username      = $chat_obj->Username();   // get chat username from array (string)
$chat_type          = $chat_obj->Type();       // get chat type from array (string)

// ================== return chat (reply_to_message) of message ==================
$chat_reply_to_message_obj          = $update->ReplyToMessage();
$chat_reply_to_message_obj = $update->ReplyToMessage();
$reply_from_obj           = $chat_reply_to_message_obj->From();           // Get from info from reply_to_message of message (array)
$reply_message_id         = $chat_reply_to_message_obj->GetMessageID();   // Get message id from reply_to_message of message (int)
$reply_from_id            = $reply_from_obj->ID();                              // get sender id from reply_to_message array (int)
$reply_from_is_bot        = $reply_from_obj->IsBot();                           // get sender is_bot from reply_to_message array (bool)
$reply_from_first_name    = $reply_from_obj->FirstName();                       // get sender first_name from reply_to_message array (string)
$reply_from_last_name     = $reply_from_obj->LastName();                        // get sender last_name from reply_to_message array (string)
$reply_from_username      = $reply_from_obj->Username();                        // get sender username from reply_to_message array (string)
$reply_from_language_code = $reply_from_obj->LanguageCode();

// ================== return info (forward_from_chat) of message ==================
$forward_from_message_obj       = $update->ForwardFromMessage();
$forward_from_chat              = $forward_from_message_obj->GetForwardChat();          // Get chat info from forward_from_message of message (array)
$forward_from_chat_id           = $forward_from_message_obj->GetForwardChatId();        // Get chat id from forward_from_message of message (int)
$forward_from_chat_first_name   = $forward_from_message_obj->GetForwardChatFirstName(); // Get chat first name from forward_from_message of message (string)
$forward_from_chat_last_name    = $forward_from_message_obj->GetForwardChatLastName();  // Get chat last name from forward_from_message of message (string)
$forward_from_chat_username     = $forward_from_message_obj->GetForwardChatUsername();  // Get chat username from forward_from_message of message (string)
$forward_from_chat_type         = $forward_from_message_obj->GetForwardChatType();      // Get chat type from forward_from_message of message (string)
$forward_from_chat_message_id   = $forward_from_message_obj->GetForwardFromMessageId(); // Get chat message id from forward_from_message of message (int)
$forward_from_chat_signature    = $forward_from_message_obj->GetForwardSignature();     // Get chat signature from forward_from_message of message (string)
$forward_from_chat_date         = $forward_from_message_obj->GetForwardFromDate();      // Get chat date from forward_from_message of message (int)

// ================== return info (contact) of message ==================
$contact_obj            = $update->Contact();
$contact                = $contact_obj->Get();          // Get contact info from contact of message (array)
$contact_phone_number   = $contact_obj->PhoneNumber();  // Get contact phone_number from contact of message (string)
$contact_first_name     = $contact_obj->FirstName();    // Get contact first_name from contact of message (string)
$contact_last_name      = $contact_obj->LastName();     // Get contact last_name from contact of message (string)
$contact_user_id        = $contact_obj->UserId();       // Get contact user_id from contact of message (string)
```
