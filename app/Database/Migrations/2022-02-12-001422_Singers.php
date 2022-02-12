<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Singers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'date'       => [
                'type' => 'TEXT',
                    'null' => TRUE,
            ],
            'bibliography' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image'       => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'gender'       => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('singers');
    }

    public function down()
    {
        $this->forge->dropTable('singers');
    }
}