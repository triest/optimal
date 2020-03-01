<?php

    if (isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];
        $qwery = "SELECT o1.`order_id`, o2.`order_status`
        FROM `orders` o1
                 INNER JOIN `orders` o2 ON o2.`order_id` = o1.`order_id`
        WHERE o1.`order_id` = ' . $orderId";

        if ($order = DB::query($qwery)) {
            sendJson([
                    'order_id' => $order['order_id'],
                    'order_status' => $order['order_status'],
            ]);
        } else {
            sendJson(
                    [
                            'status' => 'fail',
                            'message' => sprintf('Заказ с ID `%x` не найден', $orderId)
                    ]
            );
        }
    }

    function sendJson($array)
    {
        print(json_decode($array));
    }