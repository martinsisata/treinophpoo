<?php 
/* Classe TRecord
Esta classe provê os métodos necessário para persistir e 
recuparar objectos da base de dados (Active Record)
*/
abstract calss TRecord 
{
	protected $data; //Array contendo os dados do objecto

	/* Método contrutor
	Instancia um Active Record. Se passado o $id, já carrega o objecto
	$id = Objecto id
	*/

	public function __Construct($id = NULL)
	{
		if($id) //Se existir ID
		{
			//carrega o objecto correspondente
			$objecto = $this-> load($id);
			if ($objecto)
			{
				$this->fromArray($objecto->toArray());
			}
		}
	}

	/*Método __clone()
	Executando quando o objecto for clonado
	limpa o ID para que seja gerado um novo ID para clone.
	*/

	public function __clone()
	{
		unset($this->id);
	}

	/*Método __set()
	Executado sempre que uma propriedade for atribuida.
	*/

	private function __set($prop, $value)
	{
		//Verifica se existe método set <propriedade>
		if (method_exists($this, 'set_'.$prop))
		{
			//executa o método set <proprieadde>
			call_user_func(array($this,'set_'.$prop, $value));
		}
		else
		{
			//Atribuir valor a propriedade
			$this->data[$prop] = $value;
		}
	}
	/*
	Método __get ()
	executa sempre que um apropriedade for requerida
	*/

	public function __get($prop)
	{
		//Verifica se existe método get_ <propriedade>
		if (method_exists($this, 'get_'.$prop))
		{
			//executa o método get_ <proprieadde>
			call_user_func(array($this,'get_'.$prop));
		}
		else
		{
			//retorna o valor da propriedade
			return $this-> data[$prop];
		}
	}
	/*
}


 ?>