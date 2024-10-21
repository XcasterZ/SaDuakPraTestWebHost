<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Models\Chat;
use Carbon\Carbon;

class SendChatMessageWhenAuctionEnds extends Command
{
    protected $signature = 'auction:send-chat-message';
    protected $description = 'Send chat message when auction ends';

    public function handle()
    {
        // ตรวจสอบประมูลที่หมดเวลา
        $auctions = Auction::where('end_date', '<=', Carbon::now())->get();

        foreach ($auctions as $auction) {
            $winnerId = $auction->winner; // ID ของผู้ชนะ
            $product = $auction->product; // ดึงข้อมูลผลิตภัณฑ์ที่เกี่ยวข้อง

            // ข้อมูลที่จะส่ง
            $messageData = [
                'sender' => $product->seller_id,
                'recipient' => $winnerId,
                'message' => '', // ข้อความที่ต้องการส่ง
                'product_name' => $product->name,
                'product_image' => $product->file_path_1,
                'product_price' => $auction->top_price,
                'current_url' => url('/product/' . $product->id),
            ];

            // สร้างบันทึกข้อความในฐานข้อมูล
            try {
                Chat::create($messageData);
                $this->info('Message sent for auction id: ' . $auction->id);
            } catch (\Exception $e) {
                Log::error('Error occurred while sending chat message: ' . $e->getMessage());
            }
        }
    }
}
