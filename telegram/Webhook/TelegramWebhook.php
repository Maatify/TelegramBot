<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 3:04 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhook
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook;

use Exception;
use Maatify\Functions\GeneralFunctions;
use Maatify\Logger\Logger;
use Maatify\TelegramBot\Webhook\Update\TelegramWebhookCallback;
use Maatify\TelegramBot\Webhook\Update\TelegramWebhookMessage;

class TelegramWebhook extends Webhook
{
    private static self $instance;
    public ?string $data;
    public ?int $message_id;
    public ?int $chat_id;
    public ?string $text;
    public TelegramWebhookMessage $message;
    public TelegramWebhookCallback $callback;
    public ?string $update_type;

    public static function obj(array $payload, array $headers, string $api_key): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($payload, $headers, $api_key);
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */

    protected function validate(): bool
    {
        // Basic validation, you may want to implement more robust checks
        return isset($this->payload['update_id']);
    }

    private function handleMessage($message): void
    {
        $this->message = (new TelegramWebhookMessage())->preload($message);
        $this->message_id = $this->message->message_id;
        $this->chat_id = $this->message->chat->id;
        $this->text = $this->message->text;

        // Log or process the message
        $this->logEvent('message', $message);

        // Add your message handling logic here
        // For example, you might want to store the message in a database
    }

    private function handleCallbackQuery($callbackQuery): void
    {
        $this->callback = (new TelegramWebhookCallback())->preload($callbackQuery);

        $this->logEvent('callback_query', $this->callback);
        if($this->callback->data){
            $this->data = $this->callback->data;
            $this->message_id = $this->callback->message->message_id;
            $this->chat_id = $this->callback->message->chat->id;
        }

        // Add your callback query handling logic here
        // This is where you'd handle button clicks from inline keyboards
    }

    private function logEvent($type, $data): void
    {
        // Implement your logging logic here
        // This could be writing to a file, database, or external logging service
        $logEntry['time'] = date('Y-m-d H:i:s');
        $logEntry['type'] = $type;
        $logEntry['data'] = $data;
        Logger::RecordLog($logEntry, 'telegram_webhook_log'. GeneralFunctions::CurrentMicroTimeStamp());
    }

    /**
     * @throws Exception
     */
    public function process(): void
    {
        if (!$this->validate()) {
            throw new Exception('Invalid Telegram webhook payload');
        }

        $updateType = $this->getUpdateType();

        switch ($updateType) {
            case 'message':
                $this->handleMessage($this->payload['message']);
                break;
            case 'edited_message':
                $this->handleEditedMessage($this->payload['edited_message']);
                break;
            case 'channel_post':
                $this->handleChannelPost($this->payload['channel_post']);
                break;
            case 'edited_channel_post':
                $this->handleEditedChannelPost($this->payload['edited_channel_post']);
                break;
            case 'inline_query':
                $this->handleInlineQuery($this->payload['inline_query']);
                break;
            case 'chosen_inline_result':
                $this->handleChosenInlineResult($this->payload['chosen_inline_result']);
                break;
            case 'callback_query':
                $this->handleCallbackQuery($this->payload['callback_query']);
                break;
            case 'shipping_query':
                $this->handleShippingQuery($this->payload['shipping_query']);
                break;
            case 'pre_checkout_query':
                $this->handlePreCheckoutQuery($this->payload['pre_checkout_query']);
                break;
            case 'poll':
                $this->handlePoll($this->payload['poll']);
                break;
            case 'poll_answer':
                $this->handlePollAnswer($this->payload['poll_answer']);
                break;
            case 'my_chat_member':
                $this->handleMyChatMember($this->payload['my_chat_member']);
                break;
            case 'chat_member':
                $this->handleChatMember($this->payload['chat_member']);
                break;
            case 'chat_join_request':
                $this->handleChatJoinRequest($this->payload['chat_join_request']);
                break;
            default:
                $this->handleUnknownUpdate($updateType);
        }
    }

    private function getUpdateType(): string
    {
        $updateTypes = [
            'message', 'edited_message', 'channel_post', 'edited_channel_post',
            'inline_query', 'chosen_inline_result', 'callback_query',
            'shipping_query', 'pre_checkout_query', 'poll', 'poll_answer',
            'my_chat_member', 'chat_member', 'chat_join_request'
        ];

        foreach ($updateTypes as $type) {
            if (isset($this->payload[$type])) {
                $this->update_type = $this->payload[$type];
                return $type;
            }
        }

        return 'unknown';
    }

    // Implement these methods based on your requirements
    private function handleEditedMessage($editedMessage) { /* ... */ }
    private function handleChannelPost($channelPost) { /* ... */ }
    private function handleEditedChannelPost($editedChannelPost) { /* ... */ }
    private function handleInlineQuery($inlineQuery) { /* ... */ }
    private function handleChosenInlineResult($chosenInlineResult) { /* ... */ }
    private function handleShippingQuery($shippingQuery) { /* ... */ }
    private function handlePreCheckoutQuery($preCheckoutQuery) { /* ... */ }
    private function handlePoll($poll) { /* ... */ }
    private function handlePollAnswer($pollAnswer) { /* ... */ }
    private function handleMyChatMember($myChatMember) { /* ... */ }
    private function handleChatMember($chatMember) { /* ... */ }
    private function handleChatJoinRequest($chatJoinRequest) { /* ... */ }
    private function handleUnknownUpdate($updateType) { /* ... */ }

    // Existing methods (handleMessage, handleCallbackQuery, etc.) remain the same

}