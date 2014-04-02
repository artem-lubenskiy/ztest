<?php

/**
 * Description of UsersTable
 *
 * @author artem
 */
namespace Users\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class UsersTable {
    protected $_tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->_tableGateway = $tableGateway;
    }
    
    public function saveUser(Users $user) {
        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        );
        $id = (int)$user->id;
        if($id == 0) {
            $this->_tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->_tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('User ID does not exist.');
            }
        }
    }
    public function getUser($id) {
        $id = (int)$id;
        $rowset = $this->_tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row) {
            throw new \Exception('User not found.');
        }
        return $row;
    }
}
