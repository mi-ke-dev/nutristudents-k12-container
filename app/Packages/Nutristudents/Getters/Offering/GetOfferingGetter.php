<?php
namespace Bytelaunch\Nutristudents\Getters\Offering;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site;

class GetOfferingGetter
{
    private User $user;
    private array $select = [];
    private array $type = [];
    private $orderBy = 'name';
    private $orderByType = 'asc';
    private Site $site;
    private $is_headcount = false;

    public function setHeadCount($is_headcount = false) :self
    {
        $this->is_headcount = $is_headcount;
        return $this;
    }

    public function forUser(User $user) :self
    {
        $this->user = $user;
        return $this;
    }

    public function forSite(Site $site) :self
    {
        $this->site = $site;
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
            $offering = Offering::select($this->select);
        } else {
            $offering = Offering::select('*');
        }
        $offering->where('site_id', $this->site->id);
        // dd(!$this->user->isSuperUser());
        if(!$this->user->isSuperUser()){
            if($this->type && count ($this->type) > 0 ){
                $types = $this->type;
                $user = $this->user;

                $offering->where(function($q) use($types, $user) {
                    foreach($types as $k => $v){
                        if($k == 0){
                            $q->whereRelation($v, 'user_id', '=', $user->id);
                        } else {
                            $q->orWhereRelation($v, 'user_id', '=', $user->id);
                        }
                    }                    
                });
                
            }
            // if($this->type && $this->type != ''){
            //     $offering->whereRelation($this->type, 'user_id', '=', $this->user->id);
            // }            
        }

        
        
        $offering->orderBy($this->orderBy, $this->orderByType);
        $offering = $offering->get();

        if($this->is_headcount){
            $user = $this->user;
            $offering->map(function($q) use ($user){
                if($user->isSuperUser()){
                    $q->is_headcount = true;
                    $q->is_menuplanner = true;
                } else {
                    $h = $q->headcounts()->where('user_id',  $this->user->id)->where('type', 'headcounts');
                    $mp = $q->menu_planings()->where('user_id',  $this->user->id)->where('type', 'menu_planings');
                    if($h && $h->count() > 0){
                        $q->is_headcount = true;
                    } else {
                        $q->is_headcount = false;
                    }

                    if($mp && $mp->count() > 0){
                        $q->is_menuplanner = true;
                    } else {
                        $q->is_menuplanner = false;
                    }
                } 
            });
        }

        return $offering;        
    }
}

?>