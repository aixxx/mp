<?php

return [
     // 存储目录
    'storage_path'    => public_path('attachments/'),

    // 图片最大大小
    'upload_max_size' => 2 * 1024 * 1024, // 5M

    // 图片路径前缀， 如果使用第三方存储请添加域名
    'prefix'          => '/attachments', // 不要最后的斜线
];