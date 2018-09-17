<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180622125439 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("USE users");
        $this->addSql("CREATE TABLE userdata (userid INT NOT NULL PRIMARY KEY, firstname TEXT, surname TEXT, type CHAR(32), lastlogintime TIMESTAMP)");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("USE users");
        $this->addSql("DROP TABLE userdata");
    }
}
