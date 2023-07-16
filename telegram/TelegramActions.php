<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 2:17 PM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Liberary    TelegramBot
 * @see https://www.maatify.dev Visit Maatify.dev
 * @link https://github.com/Maatify/TelegramBot View project on GitHub
 *
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @copyright ©2023 Maatify.dev
 * @note    This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot;

class TelegramActions
{
    private static self $instance;

    public static function obj(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /** Sets chat status as Typing. */
    public const TYPING = 'typing';

    /** Sets chat status as Sending Photo. */
    public const UPLOAD_PHOTO = 'upload_photo';

    /** Sets chat status as Recording Video. */
    public const RECORD_VIDEO = 'record_video';

    /** Sets chat status as Sending Video. */
    public const UPLOAD_VIDEO = 'upload_video';

    /** Sets chat status as Recording Voice. */
    public const RECORD_VOICE = 'record_voice';

    /** Sets chat status as Sending Voice. */
    public const UPLOAD_VOICE = 'upload_voice';

    /** Sets chat status as Sending Document. */
    public const UPLOAD_DOCUMENT = 'upload_document';

    /** Sets chat status as Choosing Sticker. */
    public const CHOOSE_STICKER = 'choose_sticker';

    /** Sets chat status as Choosing Geo. */
    public const FIND_LOCATION = 'find_location';

    /** Sets chat status as Recording Video Note. */
    public const RECORD_VIDEO_NOTE = 'record_video_note';

    /** Sets chat status as Sending Video Note. */
    public const UPLOAD_VIDEO_NOTE = 'upload_video_note';
}