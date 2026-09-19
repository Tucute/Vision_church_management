<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Nguyễn Thị Lan',
                'email' => 'lan.nguyen@example.com',
                'phone' => '0912345678',
                'subject' => 'Hỏi về lịch nhóm Chủ Nhật',
                'message' => 'Chào Hội Thánh, cho em hỏi lịch nhóm Chủ Nhật tuần này có thay đổi gì không ạ? Em cảm ơn.',
                'status' => 'replied',
            ],
            [
                'name' => 'Trần Văn Minh',
                'email' => 'minh.tran@example.com',
                'phone' => '0987654321',
                'subject' => 'Đăng ký tham gia Ban Truyền Giáo',
                'message' => 'Tôi muốn tìm hiểu thêm về Ban Truyền Giáo và cách tham gia. Mong nhận được phản hồi sớm.',
                'status' => 'read',
            ],
            [
                'name' => 'Lê Thị Hương',
                'email' => 'huong.le@example.com',
                'phone' => '0909112233',
                'subject' => 'Hỏi về chuyến Trại Hè',
                'message' => 'Chuyến Trại Hè Thanh Niên sắp tới còn nhận đăng ký không ạ? Con tôi 16 tuổi có tham gia được không?',
                'status' => 'new',
            ],
            [
                'name' => 'Phạm Quốc Bảo',
                'email' => 'bao.pham@example.com',
                'phone' => null,
                'subject' => 'Góp ý website',
                'message' => 'Website của Hội Thánh rất đẹp và dễ dùng. Mong có thêm phần video bài giảng để xem lại.',
                'status' => 'new',
            ],
            [
                'name' => 'Đỗ Thị Mai',
                'email' => 'mai.do@example.com',
                'phone' => '0977889900',
                'subject' => null,
                'message' => 'Xin chào, tôi mới chuyển đến khu vực gần đây và muốn tìm một Hội Thánh để sinh hoạt. Xin phép được ghé thăm vào Chủ Nhật này ạ.',
                'status' => 'new',
            ],
        ];

        foreach ($messages as $data) {
            ContactMessage::create($data);
        }
    }
}