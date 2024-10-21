<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Models\Chat;

class SendAuctionEndMessages extends Command
{
    protected $signature = 'auction:end-messages';
    protected $description = 'Send messages when auctions end';

    public function handle()
    {
        $auctions = Auction::where('end_time', '<=', now())->get(); // ตรวจสอบการประมูลที่สิ้นสุด

        foreach ($auctions as $auction) {
            // ดึงข้อมูลผู้ชนะและสินค้า
            $winnerId = $auction->winner;
            $productId = $auction->product_id;

            // ส่งข้อความ
            Chat::create([
                'sender' => $auction->seller_id, // ID ของผู้ขาย
                'recipient' => $winnerId, // ID ของผู้ชนะ
                'message' => 'การประมูลสิ้นสุดแล้ว!', // ข้อความ
                'product_name' => $auction->product->name, // ชื่อสินค้า
                'product_image' => $auction->product->file_path_1, // รูปสินค้า
                'product_price' => $auction->top_price, // ราคาสินค้า
                'current_url' => url('/product/' . $productId), // URL ของผลิตภัณฑ์
            ]);
        }
    }
}
