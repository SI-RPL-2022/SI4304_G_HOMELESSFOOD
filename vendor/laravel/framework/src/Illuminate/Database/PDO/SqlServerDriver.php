<?php

namespace Illuminate\Database\PDO;

use Doctrine\DBAL\Driver\AbstractSQLServerDriver;

class SqlServerDriver extends AbstractSQLServerDriver
{
<<<<<<< HEAD
    /**
     * @return \Doctrine\DBAL\Driver\Connection
     */
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function connect(array $params)
    {
        return new SqlServerConnection(
            new Connection($params)
        );
    }
}
