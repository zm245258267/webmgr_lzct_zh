<?php
namespace backend\services;

use backend\models\GameCmd;

class GameCmdService extends GameCmd
{

    /**
     * 表单参数格式化成JSON
     *
     * @param array $params            
     * @return string|NULL
     */
    public function formatFormSettings($params)
    {
        if (empty( $params ))
            return null;
        // 配置参数处理
        $settings = [ ];
        foreach ( $params['name'] as $key => $val ) {
            if ($val == '')
                continue;
            $settings[$key]['name'] = $val;
            $settings[$key]['key'] = $params['key'][$key];
            $settings[$key]['desc'] = $params['desc'][$key];
            $settings[$key]['value'] = $params['value'][$key];
        }
        return (empty( $settings ) ? null : json_encode( $settings, JSON_UNESCAPED_UNICODE ));
    }
}
