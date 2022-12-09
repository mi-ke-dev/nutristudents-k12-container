<?php
namespace Bytelaunch\Nutristudents\Getters\Sites;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;

class GetMenuCreationGetter
{
    private User $user;
    private array $select = [];
    private array $type = [];
    private $orderBy = 'name';
    private $orderByType = 'asc';

    public function forUser(User $user) :self
    {
        $this->user = $user;
        return $this;
    }

    public function selects($select = []) : self
    {
        $this->select = $select;
        return $this;
    }

    public function forType($type = ''): self
    {
        if($type && $type != ''){
            $this->type = explode(',', $type);
        }        
        return $this;
    }

    public function OrderBy($orderBy, $orderByType): self
    {
        $this->orderBy = $orderBy;
        $this->orderByType = $orderByType;
        return $this;
    }


    public function get() 
    {
        // Site::where
        if(count($this->select)>0){
            $sites = MenuCreationGroup::select($this->select);
        } else {
            $sites = MenuCreationGroup::select('*');
        }

        if(!$this->user->isSuperUser()){
            if($this->type && count ($this->type) > 0 ){
                $types = $this->type;
                $user = $this->user;

                $sites->where(function($q) use($types, $user) {
                    foreach($types as $k => $v){
                        if($k == 0){
                            $q->whereRelation($v, 'user_id', '=', $user->id);
                        } else {
                            $q->orWhereRelation($v, 'user_id', '=', $user->id);
                        }
                    }                    
                });                
            }            
        }
        
        $sites->orderBy($this->orderBy, $this->orderByType);
        return $sites->get();        
    }
}

?>