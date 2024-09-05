<?php

namespace Fuel\Migrations;

class Create_pedreira
{
	public function up()
	{
		\DBUtil::create_table('pedreira', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_vitrine' => array('constraint' => 11, 'type' => 'int'),
			'titulo' => array('constraint' => 250, 'type' => 'varchar'),
			'thumb' => array('constraint' => 250, 'type' => 'varchar'),
			'thumb_peso' => array('constraint' => 250, 'type' => 'varchar'),
			'thumb_formato' => array('constraint' => 250, 'type' => 'varchar'),
			'thumb_tamanho' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_peso' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_formato' => array('constraint' => 250, 'type' => 'varchar'),
			'imagem_tamanho' => array('constraint' => 250, 'type' => 'varchar'),
			'ordem' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('pedreira');
	}
}