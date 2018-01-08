<?php
namespace backend\services;

use backend\models\GameCmd;
use common\utils\CommonFun;

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
            $settings[$key]['must'] = $params['must'][$key];
        }
        return (empty( $settings ) ? null : json_encode( $settings, JSON_UNESCAPED_UNICODE ));
    }

    /**
     * 格式化执行参数
     *
     * @param string $cmd            
     * @param array $params            
     * @return string|NULL
     */
    public function formatExecParams($cmd, $params)
    {
        $where = [ 
                'cmd' => $cmd 
        ];
        $settings = $this->find()
            ->select( 'settings' )
            ->where( $where )
            ->column();
        $settings = array_shift( $settings );
        
        if (is_array( $params ) && ! empty( $params )) {
            @$settings = json_decode( $settings );
            if (is_array( $settings )) {
                foreach ( $settings as $item ) {
                    if ($item['value'] == 'textarea_array') {
                        if (isset( $params[$item['key']] )) {
                            $params[$item['key']] = str_replace( [ 
                                    "\r\n",
                                    "\n" 
                            ], "\r\n", $params[$item['key']] );
                            $params[$item['key']] = explode( "\r\n", $params[$item['key']] );
                        }
                    }
                }
            }
            
            $replace = [ 
                    "\r\n",
                    "\n" 
            ];
            
            $callback = function ($val) {
                return str_replace( $replace, "<br />", $val );
            };
            
            $params = CommonFun::arrayMapRecursive( $callback, $params );
            return json_encode( $params );
        }
        
        return null;
    }

    /**
     * 参数验证
     *
     * @param string $cmd            
     * @param array $params            
     * @param string $error            
     * @return boolean
     */
    public function validateParams($cmd, $params, &$error = '')
    {
        $where = [ 
                'cmd' => $cmd 
        ];
        $settings = $this->find()
            ->select( 'settings' )
            ->where( $where )
            ->column();
        
        $settings = array_shift( $settings );
        
        if ($settings == null) {
            return true;
        }
        
        @$settings = json_decode( $settings, true );
        
        if (empty( $settings )) {
            return true;
        }
        
        foreach ( $settings as $item ) {
            if ($item['must']) {
                if ($params[$item['key']] !== 0 && $params[$item['key']] == '') {
                    $error = $item['name'] . " 不能为空";
                    return false;
                }
            }
        }
        return true;
    }
}
