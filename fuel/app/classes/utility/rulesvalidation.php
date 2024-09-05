<?php
class Utility_Rulesvalidation
{
	public static function _validation_telefone($val)
	{
		$pattern = '/^\(\d{2}\)\ ?\d{4,5}(\.|\-)?\d{4,5}$/';
		$match = preg_match($pattern, $val);
		return !empty($match);
	}

	public static function _validation_cpf($val)
	{
		$val = preg_replace('/[^0-9]/', '', (string) $val);
 
        if (strlen($val) != 11)
            return false;
     
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $val{$i} * $j;
     
        $resto = $soma % 11;
     
        if ($val{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $val{$i} * $j;
     
        $resto = $soma % 11;
     
        return $val{10} == ($resto < 2 ? 0 : 11 - $resto);
	}

	public static function _validation_cep($val)
	{
		$pattern = '/^\d{5}\-\d{3}$/';
		$match = preg_match($pattern, $val);
		return !empty($match);
	}

	public static function _validation_estado_uf($val)
	{
		$arr = array('ac', 'al', 'am', 'ap', 'ba', 'ce', 'df', 'es', 'go', 'ma', 'mg', 'ms', 'mt', 'pa', 'pb', 'pe', 'pi', 'pr', 'rj', 'rn', 'ro', 'rr', 'rs', 'sc', 'se', 'sp', 'to');

		return in_array(strtolower($val), $arr);
	}

	public static function _validation_sexo_sigla($val)
	{
		$arr = array('m', 'f');

		return in_array(strtolower($val), $arr);
	}

	public static function _validation_data($val)
	{
		$arr = explode('/', $val);

		if(count($arr) != 3){
			return false;
		}
	}

	public static function return_errors($val)
	{
		$errors = $val->error();
		$errorsArr = array();
		foreach($errors as $key=>$itemError){
			$errorsArr[] = $key;
		}
		return $errorsArr;
	}
}