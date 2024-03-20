<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\Enums\ResponseCodeEnum;

return [
    // 响应状态码
    ResponseCodeEnum::class => [
        // 成功
        ResponseCodeEnum::HTTP_OK => 'تمت العملية بنجاح', // 自定义 HTTP 状态码返回消息
        ResponseCodeEnum::HTTP_NOT_FOUND => 'لم يتم العثور على البيانات',
        ResponseCodeEnum::HTTP_INTERNAL_SERVER_ERROR => 'خطأ في الخادم',
        ResponseCodeEnum::HTTP_UNPROCESSABLE_ENTITY => 'فشل التحقق',
        ResponseCodeEnum::HTTP_UNAUTHORIZED => 'فشل التحقق من البيانات',

        // 业务操作成功
        ResponseCodeEnum::SERVICE_REGISTER_SUCCESS => '注册成功',
        ResponseCodeEnum::SERVICE_LOGIN_SUCCESS => '登录成功',

        // 业务操作失败：授权业务
        ResponseCodeEnum::SERVICE_REGISTER_ERROR => '注册失败',
        ResponseCodeEnum::SERVICE_LOGIN_ERROR => '登录失败',

        // 客户端错误
        ResponseCodeEnum::CLIENT_PARAMETER_ERROR => '参数错误',
        ResponseCodeEnum::CLIENT_CREATED_ERROR => '数据已存在',
        ResponseCodeEnum::CLIENT_DELETED_ERROR => '数据不存在',
        ResponseCodeEnum::CLIENT_VALIDATION_ERROR => '表单验证错误',

        // 服务端错误
        ResponseCodeEnum::SYSTEM_ERROR => '服务器错误',
        ResponseCodeEnum::SYSTEM_UNAVAILABLE => '服务器正在维护，暂不可用',
        ResponseCodeEnum::SYSTEM_CACHE_CONFIG_ERROR => '缓存配置错误',
        ResponseCodeEnum::SYSTEM_CACHE_MISSED_ERROR => '缓存未命中',
        ResponseCodeEnum::SYSTEM_CONFIG_ERROR => '系统配置错误',
    ],
];
