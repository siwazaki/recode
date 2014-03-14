#!/bin/bash
#git log --date=iso --pretty=format:"array('user_id'=>'%an', 'repository_id'=>2, 'updated_at'=>'%ad', 'created_at'=>'%ad', 'comments'=>\"%s\"),"
git log --date=iso --pretty=format:"array('user_id'=>'%an', 'repository_id'=>$2, 'updated_at'=>'%ad', 'created_at'=>'%ad', 'comments'=>\"\")," | sed -e 's/ +0900//g'


