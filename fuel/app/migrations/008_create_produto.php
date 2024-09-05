<?php

namespace Fuel\Migrations;

class Create_produto
{
	public function up()
	{
		\DBUtil::create_table('produto', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_galeria' => array('constraint' => 11, 'type' => 'int'),
			'id_vitrine' => array('constraint' => 11, 'type' => 'int'),
			'titulo' => array('constraint' => 250, 'type' => 'varchar'),
			'descricao' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_peso' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_formato' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_tamanho' => array('constraint' => 250, 'type' => 'varchar'),
			'slug' => array('constraint' => 250, 'type' => 'varchar'),
			'texto' => array('type' => 'text'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('produto');
	}
}