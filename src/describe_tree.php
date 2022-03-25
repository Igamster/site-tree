<?php
    function treeDB($id_parent) {
        $connect = connectDB();
        $result = mysqli_query($connect, "SELECT id, name, description, id_parent FROM object WHERE id_parent=".$id_parent);
        $rows = [];
        while($res = mysqli_fetch_array($result)) {
            $rows[] = $res;
        }
        return $rows;
    }
    function tree($id_parent){
        $rows = treeDB($id_parent);
        foreach($rows as $row){
            if(count(treeDB($row['id']))>0){
                $class="Node ExpandClosed IsLast";
            }
            else{
                $class="Node ExpandLeaf IsLast";
            }
            echo"<ul class='Container' id='".$row['id']."'><li class='".$class."'><div class='Expand'></div><input type='radio' name='object' id='".$row['id']."' value='".$row['id']."'/>";
            echo "<div class='Input InputFolder Closed'></div><div class='Input InputNear NearOff'></div><div class='Content'>".$row['name']."</div>";
            echo "<div class='DeClosed' style='display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch;'><div class='Description'></div><div class='Desc'>".$row['description']."</div></div>";
            tree($row['id']);
            echo"</li></ul>\n";
        }
    }