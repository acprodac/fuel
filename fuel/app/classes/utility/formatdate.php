<?php
class Utility_Formatdate
{
	public static function mes($int)
	{
		settype($int, 'integer');

		switch ($int){
			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;
		}

		return $mes;
	}

	public static function get_calendario($time)
	{
		$arrDia = array('dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab');

		$mes = (integer) date('n', $time);
		$ano = (integer) date('Y', $time);

		$lastDay = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
		$firstDay = date('w', mktime(0, 0, 0, $mes, 1, $ano));

		$arrReturn = array(
			'ano' => $ano,
			'mes_num' => $mes,
			'mes' => Utility_Formatdate::mes($mes),
			'prev_time' => strtotime('last day of last month', $time),
			'next_time' => strtotime('first day of next month', $time),
			'dias' => array()
		);

		for($i = 1; $i <= $lastDay; $i++){
			if($firstDay > 6){
				$firstDay = 0;
			}

			$arrReturn['dias'][] = array(
				'dia' => ($i < 10) ? '0' . $i : $i,
				'dia_semana' => $arrDia[$firstDay++]
			);
		}

		return $arrReturn;
	}
}