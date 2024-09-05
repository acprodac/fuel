<?php

namespace Fuel\Migrations;

class Create_contato
{
	public function up()
	{
		\DBUtil::create_table('contato', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nome' => array('constraint' => 250, 'type' => 'varchar'),
			'email' => array('constraint' => 250, 'type' => 'varchar'),
			'mensagem' => array('type' => 'text'),
			'ip' => array('constraint' => 15, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('contato');
	}
}