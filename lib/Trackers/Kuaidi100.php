<?php

namespace Ttshop\Express\Trackers;

use Curl\Curl;
use Ttshop\Express\Exceptions\TrackingException;
use Ttshop\Express\Status;
use Ttshop\Express\Waybill;

class Kuaidi100 extends BaseTracker implements TrackerInterface
{
    use TrackerTrait;

    public $Customer;

    public $AppKey;

    public static function getSupportedExpresses()
    {
        return [
            '澳大利亚邮政' => 'auspost',
            'AAE' => 'aae',
            '安信达' => 'anxindakuaixi',
            '百世' => 'huitongkuaidi',
            '百福东方' => 'baifudongfang',
            'BHT' => 'bht',
            '邦送' => 'bangsongwuliu',
            'CCES-国通' => 'cces',
            '中国东方（COE）' => 'coe',
            '传喜' => 'chuanxiwuliu',
            '加拿大邮政' => 'canpost',
            '大田' => 'datianwuliu',
            '德邦' => 'debangwuliu',
            '德邦' => 'debangkuaidi',
            'DPEX' => 'dpex',
            'DHL' => 'dhl',
            'DHL国际' => 'dhlen',
            'DHL德国' => 'dhlde',
            'D速' => 'dsukuaidi',
            '递四方' => 'disifang',
            'EMS' => 'ems',
            'EMS英文' => 'emsen',
            'EMS国际' => 'emsguoji',
            'EMS国际英文' => 'emsinten',
            'Fedex国际' => 'fedex',
            'Fedex国际(中文)' => 'fedexcn',
            'Fedex美国' => 'fedexus',
            'Fedex英国' => 'fedexuk',
            'Fedex英国(中文)' => 'fedexukcn',
            '飞康达' => 'feikangda',
            '飞快达' => 'feikuaida',
            '飞豹' => 'feibaokuaidi',
            '能达' => 'ganzhongnengda',
            '国通' => 'guotongkuaidi',
            '广东邮政' => 'guangdongyouzhengwuliu',
            'GLS' => 'gls',
            '共速达' => 'gongsuda',
            '汇强' => 'huiqiangkuaidi',
            '恒路' => 'hengluwuliu',
            '海外环球' => 'haiwaihuanqiu',
            '海盟' => 'haimengsudi',
            '华企' => 'huaqikuaiyun',
            '海红网送' => 'haihongwangsong',
            '京东' => 'jd',
            '极兔' => 'jtexpress',
            '佳吉' => 'jiajiwuliu',
            '佳怡' => 'jiayiwuliu',
            '加运美' => 'jiayunmeiwuliu',
            '京广' => 'jinguangsudikuaijian',
            '急先达' => 'jixianda',
            '晋越' => 'jinyuekuaidi',
            '金大' => 'jindawuliu',
            '嘉里大通' => 'jialidatong',
            '快捷' => 'kuaijiesudi',
            '跨越' => 'kuayue',
            '联昊通' => 'lianhaowuliu',
            '蓝镖' => 'lanbiaokuaidi',
            '联邦' => 'lianbangkuaidi',
            '联邦英文' => 'lianbangkuaidien',
            '立即送' => 'lijisong',
            '隆浪' => 'longlangkuaidi',
            '美国' => 'meiguokuaidi',
            '明亮' => 'mingliangwuliu',
            'OCS' => 'ocs',
            'OnTrac' => 'ontrac',
            '全际通' => 'quanjitong',
            '全日通' => 'quanritongkuaidi',
            '全一' => 'quanyikuaidi',
            '全峰' => 'quanfengkuaidi',
            '申通' => 'shentong',
            '顺丰' => 'shunfeng',
            '顺丰冷链' => 'shunfenglengyun',
            '顺丰-荷兰' => 'shunfengnl',
            '顺丰-香港' => 'shunfenghk',
            '三态' => 'santaisudi',
            '盛辉' => 'shenghuiwuliu',
            '速尔' => 'suer',
            '上大' => 'shangda',
            '赛澳递' => 'saiaodi',
            '红马甲' => 'sxhongmajia',
            '圣安' => 'shenganwuliu',
            '穗佳' => 'suijiawuliu',
            '天天' => 'tiantian',
            '天地华宇' => 'tiandihuayu',
            'TNT（中文结果）' => 'tnt',
            'TNT（英文结果）' => 'tnten',
            '通和天下' => 'tonghetianxia',
            'UPS（中文结果）' => 'ups',
            'UPS（全球件）' => 'upsen',
            'USPS（中英文）' => 'usps',
            '万家' => 'wanjiawuliu',
            '万象' => 'wanxiangwuliu',
            '微特派' => 'weitepai',
            '信丰' => 'xinfengwuliu',
            '香港邮政' => 'hkpost',
            '邮政' => 'youzhengguonei',
            '邮政国际' => 'youzhengguoji',
            '圆通' => 'yuantong',
            '韵达' => 'yunda',
            '运通中港' => 'yuntongkuaidi',
            '远成' => 'yuanchengwuliu',
            '亚风' => 'yafengsudi',
            '一邦' => 'yibangwuliu',
            '优速' => 'youshuwuliu',
            '元智捷诚' => 'yuanzhijiecheng',
            '越丰' => 'yuefengwuliu',
            '源安达' => 'yuananda',
            '原飞航' => 'yuanfeihangwuliu',
            '忠信达' => 'zhongxinda',
            '芝麻开门' => 'zhimakaimen',
            '银捷' => 'yinjiesudi',
            '中通' => 'zhongtong',
            '宅急送' => 'zhaijisong',
            '中邮' => 'zhongyouwuliu',
            '中速' => 'zhongsukuaidi',
            '中天万运' => 'zhongtianwanyun',
        ];
    }

    public function track(Waybill $waybill)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type','application/x-www-form-urlencoded');
        $requestData = [
            'customer' => $this->Customer,
            'param' => [
                'com' => static::getExpressCode($waybill->express),
                'num' => $waybill->id,
                'resultv2' => '6'
            ],
        ];
        if ($requestData['param']['com'] == 'shunfeng') {
            $requestData['param']['phone'] = $waybill->mobile;
        }
        $requestData['param'] = json_encode($requestData['param'],320);
        $requestData['sign'] = strtoupper(md5( $requestData['param'].$this->AppKey.$this->Customer));
        $requestDataSub = '';
        foreach ($requestData as $k => $v) {
            $requestDataSub .= $k."=".urlencode($v)."&";
        }
        $requestDataSub = substr($requestDataSub,0,-1);
        $curl->post('https://poll.kuaidi100.com/poll/query.do',$requestDataSub);
        $response = static::getJsonResponse($curl);
        if ($response->status != 200) {
            throw new TrackingException($response->message, $response);
        }
        $statusMap = [
            0 => Status::STATUS_TRANSPORTING,
            1 => Status::STATUS_PICKEDUP,
            2 => Status::STATUS_REJECTED,
            3 => Status::STATUS_DELIVERED,
            4 => Status::STATUS_RETURNED,
            5 => Status::STATUS_DELIVERING,
            6 => Status::STATUS_RETURNING,
        ];
        $waybill->status = $statusMap[intval($response->state)];
        foreach ($response->data as $trace) {
            $waybill->traces->append($trace->time, $trace->context, $trace->location);
        }
    }
}
