
# Installation

```shell
composer require maatify/telegram-bot
```
https://core.telegram.org/bots/api#available-methods // telegram api references

# Usage

### Instance
```php
use Maatify\TelegramBot\TelegramBotManager;

require __DIR__ . '/vendor/autoload.php';

$telegram = TelegramBotManager::obj(__YOUR_API_KEY__); // instance of bot manager
```

### GetMe
###### Get Bot Information
A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
```php
$response = $telegram->Methods()->GetMe(); // get bot account information

print_r($response);
```

### logOut
Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
```php
$logout = $telegram->Methods()->Logout();
print_r($logout);
```
### Close
Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
```php
$close = $telegram->Methods()->Close();
print_r($close);
```


#
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

$update = (new WebhookUpdate())->Update();
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
```


#
#
### Updates
###### Get All Updates 
###### (To get the list of updates, the web Hook should not be set)
```php
$response = $telegram->GetUpdates(); // get updates

print_r($response);
```

### Initiate Update
###### Set Update from All Updates
```php
$update = $telegram->LastUpdate(); // get Last Update
// OR
$update = $telegram->FirstUpdate(); // get First Update
// OR
$update = $telegram->Update(1); // get Index Update
```

### Get Message
###### Get Message Array from Initiated Update
```php
$response = $update->GetMessage();

print_r($response);
```

### Get Message Info from Update
###### Get Message Info from Initiated Update
```php
$message_id     = $update->UpdateID();      // get Message Update ID  (int)
$message_id     = $update->GetMessageID();  // get Message ID  (int)
$message_array  = $update->GetMessage();    // get message array (array)
$from_array     = $update->GetFrom();       // get message from array (array)
$chat_array     = $update->GetChat();       // get message chat array (array)
$text           = $update->GetText();       // get message text (string)
$date           = $update->GetDate();       // get message Date as timestamp (int)
```

### Get From of Message
###### Get From Info from Initiated Update
```php

$from_obj           = $update->From();
$from_array         = $update->GetFrom();        // get message from array (array)
$from_id            = $from_obj->ID();           // get sender id from message array (int)
$from_is_bot        = $from_obj->IsBot();        // get sender is_bot from message array (bool)
$from_first_name    = $from_obj->FirstName();    // get sender first_name from message array (string)
$from_last_name     = $from_obj->LastName();     // get sender last_name from message array (string)
$from_username      = $from_obj->Username();     // get sender username from message array (string)
$from_username      = $from_obj->LanguageCode(); // get sender language_code from message array (string)
```

### Get Chat of Message
###### Get Chat Info from Initiated Update
```php
$chat_obj           = $update->Chat();
$chat_array         = $update->GetChat();      // get chat from array (array)
$chat_id            = $chat_obj->ID();         // get chat id from array (int)
$chat_first_name    = $chat_obj->FirstName();  // get chat first_name from array (string)
$chat_last_name     = $chat_obj->LastName();   // get chat last_name from array (string)
$chat_username      = $chat_obj->Username();   // get chat username from array (string)
$chat_type          = $chat_obj->Type();       // get chat type from array (string)
```

### Get Messages With Groups
###### Get Message array from All Updates With Group By Type
```php
$grouped                    = $telegram->UpdatesGrouped();
$updates_by_chat_id         = $grouped->ByChatID();     // get updates Grouped by chat id
$updates_by_chat_username   = $grouped->ByUsername();   // get updates Grouped by chat username
$updates_by_chat_first_name = $grouped->ByFirstName();  // get updates Grouped by chat first_name
```

### GetChat
###### Get Chat By chat_id
```php
$chat = $telegram->GetChat(123456); // set getChat by chat_id

$by_chat                = $chat->Get();                 // get array of getChat
$chat_id                = $chat->GetID();               // get id from getChat by chat_id
$chat_first_name        = $chat->GetFirstName();        // get first_name from getChat
$chat_last_name         = $chat->GetLastName();         // get last_name from getChat
$chat_username          = $chat->GetUsername();         // get username from getChat
$chat_type              = $chat->GetType();             // get type from getChat
$chat_active_username   = $chat->GetActiveUsername();   // get array of active_username from getChat
```

## Sending Files, Messages, Actions
### Instance
```php
$sender = $telegram->Sender();
```
## Messages Send, Reply, Forward
### Sending Message
```php
$sent = $sender->SendMessage($chat_id, 'this is test Message', $reply_to_message_id = 0);
```
### Forward Message
forward text message from chat to another chat
```php
$sent = $sender->ForwardMessage($chat_id, $from_chat_id, $message_id);
```
### Copy Message
copy text message from chat to another chat
```php
$sent = $sender->CopyMessage($chat_id, $from_chat_id, $message_id);
```
###
## Sending Files
```php
// file can be File Location
$file_or_url = __DIR__ . '/test.png';
// file can be URL
$file_or_url = 'https://www.ep4n.net/images/merchants/20-1661781826.png';
```

### sendPhoto
Use this method to send photos. On success, the sent Message is returned.
```php
$sent = $sender->SendPhoto($chat_id, $file_or_url, $reply_to_message = 0, $caption = '', $has_spoiler = false);
```
### sendAudio
Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
####
For sending voice messages, use the sendVoice method instead.
```php
$sent = $sender->SendAudio($chat_id, $file_or_url, $reply_to_message_id = 0, $caption = '', $title = '');
```
### sendDocument
Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
```php
$sent = $sender->SendDocument($chat_id, $file_or_url, $reply_to_message_id = 0, $caption = '');
```
### sendVideo
Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
```php
$sent = $sender->SendVideo($chat_id, $file_or_url, $reply_to_message_id = 0, $caption = '');
```
### sendVoice
Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
```php
$sent = $sender->SendVoice($chat_id, $file_or_url, $reply_to_message_id = 0, $caption = '');
```
### sendVideoNote
As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
```php
$sent = $sender->SendVideoNote($chat_id, $file_or_url, $reply_to_message_id = 0);
```
#
## sendChatAction
Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
```php
$sent = $sender->Action()->Typing($chat_id);
$sent = $sender->Action()->UploadPhoto($chat_id);
$sent = $sender->Action()->RecordVideo($chat_id);
$sent = $sender->Action()->UploadVideo($chat_id);
$sent = $sender->Action()->RecordVoice($chat_id);
$sent = $sender->Action()->UploadVoice($chat_id);
$sent = $sender->Action()->UploadDocument($chat_id);
$sent = $sender->Action()->ChooseSticker($chat_id);
$sent = $sender->Action()->FindLocation($chat_id);
$sent = $sender->Action()->RecordVideoNote($chat_id);
$sent = $sender->Action()->UploadVideoNote($chat_id);
```
#
## getUserProfilePhotos
Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
```php
try {
    $telegram->Downloader()->DownloadUserProfilePhotos($user_id);
} catch (Exception $e) {
    print_r($e->getMessage());
}
```

