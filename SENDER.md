
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