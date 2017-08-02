<?php
namespace LWechat\Staff;
use LWechat\Core\Exceptions\RuntimeException;
use LWechat\Message\Type\Text;

class MessageBuilder
{
    /**
     * Message to send.
     *
     * @var \LWechat\Message\Type\AbstractMessage;
     */
    protected $message;

    /**
     * Message target user open id.
     *
     * @var string
     */
    protected $to;

    /**
     * Message sender staff id.
     *
     * @var string
     */
    protected $account;

    /**
     * Staff instance.
     *
     * @var \LWechat\Staff\Staff
     */
    protected $staff;

    /**
     * MessageBuilder constructor.
     *
     * @param \LWechat\Staff\Staff $staff
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }


    /**
     * Set message to send.
     * @param $message
     * @return $this
     */
    public function message($message)
    {
        if (is_string($message)) {
            $message = new Text(['content' => $message]);
        }

        $this->message = $message;

        return $this;
    }

    /**
     * Set target user open id.
     *
     * @param string $openId
     *
     * @return MessageBuilder
     */
    public function to($openId)
    {
        $this->to = $openId;

        return $this;
    }

    public function send()
    {
        if (empty($this->message)) {
            throw new RuntimeException('No message to send.');
        }

        $transformer = new Transformer();

//        if ($this->message instanceof RawMessage) {
//            $message = $this->message->get('content');
//        } else {
//            $content = $transformer->transform($this->message);
//
//            $message = array_merge([
//                'touser' => $this->to,
//                'customservice' => ['kf_account' => $this->account],
//            ], $content);
//        }
        $content = $transformer->transform($this->message);

        $message = array_merge([
            'touser' => $this->to,
            'customservice' => ['kf_account' => $this->account],
        ], $content);

        return $this->staff->send($message);
    }
}