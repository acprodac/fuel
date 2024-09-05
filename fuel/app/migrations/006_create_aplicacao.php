<?php

namespace Fuel\Migrations;

class Create_aplicacao
{
	public function up()
	{
		\DBUtil::create_table('aplicacao', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'titulo' => array('constraint' => 250, 'type' => 'varchar'),
			'slug' => array('constraint' => 250, 'type' => 'varchar'),
			'ordem' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('aplicacao');
	}
}