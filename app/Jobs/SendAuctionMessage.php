<?php

namespace App\Jobs;

use App\Models\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAuctionMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productName;
    protected $productImage;
    protected $currentPrice;
    protected $currentUrl;
    protected $userId;
    protected $recipient;

    public function __construct($productName, $productImage, $currentPrice, $currentUrl, $userId, $recipient)
    {
        $this->productName = $productName;
        $this->productImage = $productImage;
        $this->currentPrice = $currentPrice;
        $this->currentUrl = $currentUrl;
        $this->userId = $userId;
        $this->recipient = $recipient;
    }

    public function handle()
    {
        $messageData = [
            'sender' => $this->userId,
            'recipient' => $this->recipient,
            'message' => 'การประมูลจบลงแล้วสำหรับสินค้า: ' . $this->productName,
            'product_image' => $this->productImage,
            'product_price' => $this->currentPrice,
            'current_url' => $this->currentUrl,
        ];

        Chat::create($messageData);
    }
}