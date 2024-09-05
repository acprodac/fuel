<?php

namespace Fuel\Migrations;

class Create_institucional
{
	public function up()
	{
		\DBUtil::create_table('institucional', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_vitrine' => array('constraint' => 11, 'type' => 'int'),
			'id_galeria' => array('constraint' => 11, 'type' => 'int'),
			'titulo' => array('constraint' => 250, 'type' => 'varchar'),
			'descricao' => array('type' => 'text'),
			'slug' => array('constraint' => 250, 'type' => 'varchar'),
			'fields' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('institucional');
	}
}