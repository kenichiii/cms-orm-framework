<?php
class Datum
{
    public static function form2time($jnY){
        $datum  = explode(".",$jnY);
        $cas = array();
        $cas[0] = 12; $cas[1] = 0; $cas[2] = 0;

        return mktime( intval($cas[0]), intval($cas[1]), intval($cas[2]),
                 intval($datum[1]), intval($datum[0]), intval($datum[2]) );
    }

    
    public static function db2date( $dateTime, $returnedFormat = 'j.n.Y' ) {

          if( $dateTime == null ) return null;

          //kdyby nahodou to byl datetime
          $rozdel = explode(" ",$dateTime);
          $datum  = explode("-",$rozdel[0]);
           $cas = array();
           if( isset( $rozdel[1] ) ) $cas = explode(":",$rozdel[1]);
           else  { $cas[0] = 12; $cas[1] = 0; $cas[2] = 0; }

          $time = mktime( intval($cas[0]), intval($cas[1]), intval($cas[2]),
                          intval($datum[1]), intval($datum[2]), intval($datum[0]) );
          return date( $returnedFormat, $time );
    }
}

class Model_Component_Datatable_dataGrid extends Model_Component_Datatable_dataTable
{
    protected $lang;
    protected $defaultLanguage = "cz";
    protected $languagePack = array(
      "cz" => array(
        'filters_submit' => 'Filtrovat',
        'add_button' => 'Přidat',
        'count_all_text' => 'z celkem',
        'count_all_text_end' => 'záznamů',
        'bit_all' => 'vše',
        'bit_yes' => 'ano',
        'bit_no' => 'ne',
        'find_nothing' => 'Pro Vámi hledaná kriteria nebylo nic nalezeno.',
        'all_or_none' => 'Select/unselect vše',
        'choose_text' => 'Vyberte' ,
        'reset_filters' => 'Reset filtrů',
        'selected_checkboxes_text_selected' => 'Označených',           
        'perPage' => 'na stránce',
      ),  
      "en" => array(  
        'filters_submit' => 'Search',
        'add_button' => 'add new',
        'count_all_text' => 'from totaly',
        'count_all_text_end' => 'records',
        'bit_all' => 'all',
        'bit_yes' => 'yes',
        'bit_no' => 'no',
        'find_nothing' => 'No relevant data found with your search.',
        'all_or_none' => 'Select/unselect all',
        'choose_text' => 'Choose action' ,
        'reset_filters' => 'Reset filters',
        'selected_checkboxes_text_selected' => 'Selected',   
        'perPage' => 'per page',
       )
    );
    
    protected $htmlID;

    protected $model = array(
        "collum" => array(
          "title" => "string",
          "model" => "text|datetime|none|key|date|select",
          "filter" => "text|datetime|none|date|key|select",
        //"table" => "table alias" //using joins in db query
        //"where" => "full collum name|_custom" //using joins in db query or aliasing model[collum]
        //'not-sortable' => true,
            //render => methodName(dataBean $rowClass)
            //            "custom_autoOrderBy"=> "sortFullname($sort)",
           //             "custom_autoGroupBy" => " GROUP BY lastname,firstname", //lastname rules!
            //          "custom_function" => "assemblyFullname($value)",
            
          )
        );
   
    
    public $PER_PAGE;
    protected $actions = array();
    protected $checkBoxActions = array();
    protected $filters;
    protected $sortingFilters;

    const MODE_AUTOCOMPLETE = "autocomplete";
    const MODE_DEBUG = "showSql";

    public static $DEBUG_DATAGRID_SQL = false;

                                 //'mode' =>
                                    //autocomplete - sortingCol
    public function __construct( $filters = null, $autoloadSorting = true, $lang = null )
    {
      $this->lang = $lang ? $lang : $this->defaultLanguage;    
        
      if( is_array($filters) )
      {
        $this->filters = $filters;

        if( $autoloadSorting )
        {
            $sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : ( isset($filters['sorting']) ? $filters['sorting'] : "ASC" );
            $collum  = isset($_REQUEST['sortingCol']) ? $_REQUEST['sortingCol'] :  ( isset($filters['sortingCol']) ? $filters['sortingCol'] : null );
            $this->sortingFilters  = array(
                'limit' => isset($_REQUEST['limit']) ? intval($_REQUEST['limit']) : ( isset($filters['limit']) ? $filters['limit'] : 0 ) ,
                'per_page' => (isset( $this->filters ["showPerPage"]) ? intval( $this->filters ["showPerPage"]) : ( isset($filters['showPerPage']) ? $filters['showPerPage'] : $this->PER_PAGE )),
                'sorting' => $sorting,
                'sortingCol' => $collum,
            );
        }
        else {
            $this->sortingFilters = $filters;
        }

        if( isset( $this->filters ["showPerPage"] ) ) $this->PER_PAGE = intval( $this->filters ["showPerPage"]);
        
        
            if(! isset($this->filters ["mode"]) && self::$DEBUG_DATAGRID_SQL ) $this->filters ["mode"]= self::MODE_DEBUG;

            $this->sorting();
            $this->assemblyFilters();
            $this->load();
      }
    }

       public function getSelect() {
                        if( isset($this->filters['mode']))
                        {
                            switch( $this->filters['mode'] ) {
                                case self::MODE_AUTOCOMPLETE:
                                   $sql = $this->modeAutocomplete( $this->sortingFilters['sortingCol'] );
                                    break;
                                default:
            $sql = "select ". implode( ', ', $this->collums ) . ' from ' . $this->table
						.' '. $this->where.' '. $this->groupBy
                                                .' '. $this->orderBy .
                                                $this->limit;

                                break;
                             }
                        }
                        else
            $sql = "select ". implode( ', ', $this->collums ) . ' from ' . $this->table
						.' '. $this->where.' '. $this->groupBy
                                                .' '. $this->orderBy .
                                                $this->limit;

		return $sql;
	}

    public function assemblyFilters()
    {
        foreach($this->filters as $filterName => $value)
        {
            
            if(  isset( $this->model[ $filterName ] ) && ( $value || isset($this->filters[ "{$filterName}_second" ]))  )
            {
              switch( $this->model[ $filterName ]["filter"] )
                {   
                  case "string-key":
                      if( isset($this->filters['mode']) && $this->filters['mode'] == self::MODE_AUTOCOMPLETE ) 
                      {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function_auto"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND {$this->model[ $filterName ]["where"]} LIKE '%".self::san($value)."%'";
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` LIKE '%".self::san($value)."%'";
                            else
                                  $this->where .= " AND `{$filterName}` LIKE '%".self::san($value)."%'";
                      } 
                      else 
                      {
                      
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND {$this->model[ $filterName ]["where"]} = '".self::san($value)."'";
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` = '".self::san($value)."'";
                            else
                                  $this->where .= " AND `{$filterName}` = '".self::san($value)."'";
                      }  
                        
                        break;
                    case "key":
                      if( isset($this->filters['mode']) && $this->filters['mode'] == self::MODE_AUTOCOMPLETE ) 
                      {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function_auto"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND {$this->model[ $filterName ]["where"]} LIKE '%".self::san($value)."%'";
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` LIKE '%".self::san($value)."%'";
                            else
                                  $this->where .= " AND `{$filterName}` LIKE '%".self::san($value)."%'";
                      } 
                      else 
                      {
                      
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND {$this->model[ $filterName ]["where"]} = ".intval($value)."";
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` = ".intval($value);
                            else
                                  $this->where .= " AND `{$filterName}` = ".intval($value)."";
                      }  
                        
                        break;
                    case "text":
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .= $this->{$this->model[ $filterName ]["custom_function"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND {$this->model[ $filterName ]["where"]} LIKE '%".self::san($value)."%'";
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` LIKE '%".self::san($value)."%'";
                            else
                                  $this->where .= " AND `{$filterName}` LIKE '%".self::san($value)."%'";
                        
                    break;

                    case "select":
                        if($value != "none")
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .= $this->{$this->model[ $filterName ]["custom_function"]}($value);  
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` = '".self::san($value)."'";
                            else
                                $this->where .= " AND `{$filterName}` = '".self::san($value)."'";
                        }
                    break;
                    case "date":
                        if( $this->filters[ $filterName ] )
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function1"]}($value);  
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator"])." '".$this->date2db($value)."'";
                            else
                                $this->where .= " AND `{$filterName} ".self::renderDatetimeOperator($this->filters["{$filterName}_operator"])."` '".$this->date2db($value)."'";
                        }
                        

                        if( $this->filters[ "{$filterName}_second" ] )
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                 $this->where .=  $this->{$this->model[ $filterName ]["custom_function2"]}($value);   
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator_second"])." '".$this->date2db( $this->filters[ "{$filterName}_second" ])."'";
                            else
                                $this->where .= " AND `{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator_second"])." '".$this->date2db( $this->filters[ "{$filterName}_second" ])."'";
                        }
                    break;

                    case "datetime":
                        if( $this->filters[ $filterName ] )
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .= $this->{$this->model[ $filterName ]["custom_function1"]}($value);   
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator"])." '".$this->date2db($value)." 00:00:00'";
                            else
                                $this->where .= " AND `{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator"])." '".$this->date2db($value)." 00:00:00'";
                        }
                        

                        if( $this->filters[ "{$filterName}_second" ] )
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function2"]}($value);   
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                $this->where .= " AND `{$this->model[ $filterName ]["table"]}`.`{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator_second"])." '".$this->date2db( $this->filters[ "{$filterName}_second" ])." 23:59:59'";
                            else
                                $this->where .= " AND `{$filterName}` ".self::renderDatetimeOperator($this->filters["{$filterName}_operator_second"])." '".$this->date2db( $this->filters[ "{$filterName}_second" ])." 23:59:59'";
                        }
                    break;

                    case "bit":
                        if( $value != "none"  )
                        {
                            if( isset($this->model[ $filterName ]["where"]) && $this->model[ $filterName ]["where"] == "_custom" )
                                  $this->where .=  $this->{$this->model[ $filterName ]["custom_function"]}($value);  
                            elseif( isset($this->model[ $filterName ]["where"]) )
                                  $this->where .= " AND ({$this->model[ $filterName ]["where"]} = ".($value == "ano" ? '1) ' : '0'." or {$this->model[ $filterName ]["where"]} is null ) ");
                            elseif( isset($this->model[ $filterName ]["table"]) )
                                  $this->where .= " AND (`{$this->model[ $filterName ]["table"]}`.`{$filterName}` = ".($value == "ano" ? '1) ' : '0'." or `{$this->model[ $filterName ]["table"]}`.`{$filterName}` is null ) ");
                            else
                                  $this->where .= " AND (`{$filterName}`=".($value == "ano" ? '1) ' : "0 or `{$filterName}` is null) ");
                        }
                        break;

                    case "none":
                    default:
                        //none :)
                    break;
                }
            }
        }
    }

    public static function san($unescaped_string)
    {
       return mysql_real_escape_string($unescaped_string);
    }


    public function sorting() {
       
        
        
       if( isset($this->sortingFilters['limit']) && isset($this->sortingFilters['per_page']) )
       {
         $this->limit = " LIMIT {$this->sortingFilters['limit']},{$this->sortingFilters['per_page']} ";
       }

       if( isset($this->sortingFilters['sortingCol']) && $this->sortingFilters['sortingCol'] )
       {
           if( isset($this->model[  $this->sortingFilters['sortingCol']  ]["where"]) && $this->model[  $this->sortingFilters['sortingCol']  ]["where"] == '_custom' )
                $this->orderBy = $this->{$this->model[  $this->sortingFilters['sortingCol']  ]["custom_autoOrderBy"]}(self::san($this->sortingFilters['sorting']));
           elseif( isset($this->model[ $this->sortingFilters['sortingCol'] ]["table"]) )          
                $this->orderBy = " ORDER BY `{$this->model[ $this->sortingFilters['sortingCol'] ]["table"]}`.`".self::san($this->sortingFilters['sortingCol'])."` ".self::san($this->sortingFilters['sorting']);        
           else
                $this->orderBy = " ORDER BY `".self::san($this->sortingFilters['sortingCol'])."` ".self::san($this->sortingFilters['sorting']);
       }
    }


    public function head( $addButton = true, $checkBoxActions = true )
    {
        $html = '<tr class="dataGridHead ui-widget-header">';
        $html .=  $checkBoxActions ? '<td><a class="dataGridResetFilters" href="#" title="'.$this->languagePack[$this->lang]['reset_filters'].'"><span class="ui-icon ui-icon-circle-close"></span></a></td>' : '';
        
        foreach( $this->model as $collum => $data )
        {
            
             if( isset($data['render']) && $data['render'] == 'none' ) continue;
             $html .= '  <td class="'.$collum.'">'
                        .'<span class="dataGridTitle">'.(isset($data["title_{$this->lang}"]) ? $data["title_{$this->lang}"] : $data["title"]).'</span>'
                        ;
            
            if( ! isset($data['not-sortable'])  ) 
            {
                if( $this->sortingFilters['sortingCol'] == $collum && $this->sortingFilters['sorting'] == "ASC" )
                    $html .=
                             '<span class="dataGridSorting ui-state-hover">'
                            .'<span class="ui-icon ui-icon-circle-triangle-n dataGridSortUp"></span>'
                            .'</span>';
                else
                    $html .=
                             '<span class="dataGridSorting ui-state-default">'
                            .'<span class="ui-icon ui-icon-circle-triangle-n dataGridSortUp"></span>'
                            .'</span>';



                if( $this->sortingFilters['sortingCol'] == $collum && $this->sortingFilters['sorting'] == "DESC" )
                    $html .=
                             '<span class="dataGridSorting ui-state-hover">'
                            .'<span class="ui-icon ui-icon-circle-triangle-s dataGridSortDown"></span>'
                            .'</span>';
                else
                    $html .=
                             '<span class="dataGridSorting ui-state-default">'
                            .'<span class="ui-icon ui-icon-circle-triangle-s dataGridSortDown"></span>'
                            .'</span>'
                       ;
            }
             $html .= '   </td>'."\n";
        }

        $html .= $addButton ? '  <td title="'.$this->languagePack[$this->lang]['add_button'].'" class="ui-state-default dataGridAddButton"><span class="ui-icon ui-icon-circle-plus"></span> '.$this->languagePack[$this->lang]['add_button'].'</td>'."\n"
                            : '  <td></td>'."\n" ;
        $html .= '</tr>';
        $html .= '<tr class="dataGridHead ui-widget-header">';
        $html .=  $checkBoxActions ? '<td><input type="checkbox" class="dataGridCheckBoxAll" title="'.$this->languagePack[$this->lang]['all_or_none'].'" /></td>' : '';
        foreach( $this->model as $collum => $data )
        {
             if( isset($data['render']) && $data['render'] == 'none' ) continue;
             $html .= '  <td class="'.$collum.'">'.$this->renderFilter($collum,$data).'</td>'."\n";
        }
        $html .= '  <td class="ui-state-default dataGridSubmitButton"><span class="ui-icon ui-icon-circle-check" ></span> '.$this->languagePack[$this->lang]['filters_submit'].'</td>'."\n";
        $html .= '</tr>';

        return $html;
    }

    public function renderFilter( $collum, $data )
    {
        switch( $data['filter'] )
        {
          case "key":
            $value = '';
            if( isset($this->filters[ $collum ]) )
            $value = ' value="'.( is_array($this->filters[ $collum ]) ? $this->filters[ $collum ]["value"] : $this->filters[ $collum ]).'" ';
            $html = '<input autocomplete="off" class="dataGridFilterKey filterText" id="'.$this->htmlID.'_'.$collum.'" type="text" name="'.$collum.'"  '.$value.' />';
          break;   
          case "string-key":
          case "text":
            $value = '';
            if( isset($this->filters[ $collum ]) )
            $value = ' value="'.( is_array($this->filters[ $collum ]) ? $this->filters[ $collum ]["value"] : $this->filters[ $collum ]).'" ';
            $html = '<input autocomplete="off" id="'.$this->htmlID.'_'.$collum.'" type="text" name="'.$collum.'" class="filterText" '.$value.' />';
          break;
          case "date":
          case "datetime":
            $value = '';$operator='';
            $value_second = '';$operator_second = '';
            if( isset($this->filters[ $collum ]) )
            {
                $value = ' value="'.$this->filters[ $collum ].'" ';
                if( isset($this->filters[ "{$collum}_operator" ]) )
                    $operator = $this->filters[ "{$collum}_operator" ];
            }
            if( isset($this->filters[ "{$collum}_second" ]) )
            {
                $value_second = ' value="'.$this->filters[ "{$collum}_second" ].'" ';
                $operator_second = $this->filters[ "{$collum}_operator_second" ];
            }
            $html = '
                    <div class="dataGridFilterDate">
                    <select id="'.$this->htmlID.'_'.$collum.'_operator" name="'.$collum.'_operator">
                       <option '.( $operator == "isBiggerOrEqaul" ? 'selected="selected"' : '' ).' value="isBiggerOrEqual">&gt;=</option>
                       <option '.( $operator == "isBigger" ? 'selected="selected"' : '' ).' value="isBigger">&gt;&nbsp;</option>                       
                    </select>
                    od: <input autocomplete="off" id="'.$this->htmlID.'_'.$collum.'" type="text" name="'.$collum.'" class="filterDate" '.$value.' />
                    <span class="dataGridFilterDateNextButton ui-state-default"><span class="ui-icon ui-icon-circle-plus dataGridShowNextDateFilter"></span></span>
                    </div>';
            $html .= '
                    <div  class="dataGridFilterDate" style="'.( isset($this->filters[ "{$collum}_second" ]) && $this->filters[ "{$collum}_second" ] ? "" : 'display:none').'">
                    <select id="'.$this->htmlID.'_'.$collum.'_operator_second" name="'.$collum.'_operator_second">
                       <option '.( $operator_second == "isSmallerOrEqaul" ? 'selected="selected"' : '' ).' value="isSmallerOrEqual">&lt;=</option>
                       <option '.( $operator_second == "isSmaller" ? 'selected="selected"' : '' ).' value="isSmaller">&lt;&nbsp;</option>
                    </select>
                    do: <input autocomplete="off" id="'.$this->htmlID.'_'.$collum.'_second" type="text" name="'.$collum.'_second" class="filterDate" '.$value_second.' />
                    </div>';
          break;
          
          case "select":
            $html = '<select id="'.$this->htmlID.'_'.$collum.'" name="'.$collum.'">';
            if( is_array($data['values']) )
            {
                foreach($data['values'] as $key => $name)
                {
                    $html.= '<option '.((isset($this->filters[ $collum ])&&$this->filters[ $collum ]==$key)?'selected="selected"':'').' value="'.$key.'">'.$name.'</option>';
                }                                                
            }
            $html.= '</select>';
          break;
          case "bit":
                $active_radio = isset($this->filters[$collum]) ? $this->filters[$collum] : "none";
                $html = '<input'.($active_radio=="none"?' checked="checked"':'').' type="radio" name="'.$collum.'" value="none" id="'.$this->htmlID.'_'.$collum.'_all" />';
                $html.= '<label for="'.$this->htmlID.'_'.$collum.'_all">'.$this->languagePack[$this->lang]['bit_all'].'</label>&nbsp;';
                $html.= '<input'.($active_radio=="ano"?' checked="checked"':'').' type="radio" name="'.$collum.'" value="ano" id="'.$this->htmlID.'_'.$collum.'_ano" />';
                $html.= '<label for="'.$this->htmlID.'_'.$collum.'_ano">'.$this->languagePack[$this->lang]['bit_yes'].'</label>&nbsp;';
                $html.= '<input'.($active_radio=="ne"?' checked="checked"':'').' type="radio" name="'.$collum.'" value="ne" id="'.$this->htmlID.'_'.$collum.'_ne" />';
                $html.= '<label for="'.$this->htmlID.'_'.$collum.'_ne">'.$this->languagePack[$this->lang]['bit_no'].'</label>';
              break;
          default:
          case "none":
              $html = "";
              break;
        }
    
        return $html;
    }

    public function body($checkBoxActions)
    {
        $html = '';

        foreach( parent::getStorage() as $rowClass )
        {
            
            $html .= '<tr id="'.$this->htmlID.'_'.$rowClass->{$this->getPrimaryKeyRaw()}.'" class="dataGridData">';
            $html .=  $checkBoxActions ? '<td class="dataGridCheckBox"><input name="dataGridCheckBox" type="checkbox" value="'.$rowClass->{$this->getPrimaryKeyRaw()}.'" /></td>' : '';
            foreach( $this->model as $dataCollum => $data )
            {
              if( isset($data['render']) && $data['render'] == 'none' ) continue;
                    $html .= '  <td>'
                            .$this->renderDataCollum($dataCollum,$rowClass)
                            .'</td>'."\n";                                
            }
            $html .= '<td class="dataGridDataActions">'.$this->renderActions( $rowClass ).'</td>'."\n" ;
            $html .= '</tr>';
        }
        return $html;
    }

    public function renderDataCollum($dataCollum,$rowClass)
    {
        //check if is custom function
        if( $this->model[ $dataCollum ]["model"] == "bit" && !  isset($this->model[ $dataCollum ]["render"]) )
            return ( $rowClass->$dataCollum == true ? '<span class="ui-state-default dataGridCollumBit">'.$this->languagePack[$this->lang]['bit_yes'].'</span>' : '<span class="ui-state-highlight dataGridCollumBit">'.$this->languagePack[$this->lang]['bit_no'].'</span>'
            ) ;
       
        if( $this->model[ $dataCollum ]["model"] == "datetime" && !  isset($this->model[ $dataCollum ]["render"]) )
            return Datum::db2date($rowClass->$dataCollum, "j.n.Y G:i:s") ;
        elseif( $this->model[ $dataCollum ]["model"] == "date" && !  isset($this->model[ $dataCollum ]["render"]) )
            return Datum::db2date($rowClass->$dataCollum, "j.n.Y") ;
        elseif( isset($this->model[ $dataCollum ]["render"]) )
            return $this->{$this->model[ $dataCollum ]["render"]}( $rowClass );
        else
            return htmlspecialchars($rowClass->$dataCollum);
    }
    
    public function renderOptionsBar( $checkBoxActions, $count )
    {
        $html = '<tr class="dataGridOptionsBar ui-widget-header">';
        $html.= '<td colspan="'.$this->cellsCount($checkBoxActions).'">';
                
        $html.= '<div class="dataGridPerPageChooser">';
        $html.= $this->languagePack[$this->lang]['perPage'].' <input value="'.$this->PER_PAGE.'" type="text" name="showPerPage" /> '.$this->languagePack[$this->lang]['count_all_text'].' '.$count.' '.$this->languagePack[$this->lang]['count_all_text_end'];    
        $html.= '</div>';
        
        if( $checkBoxActions )
        {
            $html.= '<div class="dataGridCheckBoxActionsChooser">';
            $html.= '<div>';
            $html.= '<span class="dataGridCheckBoxActionsText">'.$this->languagePack[$this->lang]['selected_checkboxes_text_selected'].'
                       <span class="dataGridCheckBoxesCount">0</span>   
                       &nbsp;
                     <select name="dataGridCommonAction">';
            $html.= '<option value="none">'.$this->languagePack[$this->lang]['choose_text'].'</option>';
            foreach ( $this->checkBoxActions as $name => $data  )
            {
                $html.= '<option value="'.$name.'">'.$data["title_{$this->lang}"].'</option>';
            }



            $html.= '</select>';
            $html.= '</div>';
            $html.= ' <a href="#" class="dataGridCommonActionSubmit ui-state-default"><span class="ui-icon ui-icon-circle-triangle-e"></span></a>';
            
            $html.= '</div>';
        }   
        else {
            $html .=  '<a class="dataGridResetFilters" href="#" title="'.$this->languagePack[$this->lang]['reset_filters'].'"><span class="ui-icon ui-icon-circle-close"></span></a>';
        }

        
        $html.= '</td>';
        
        $html.= '</tr>';
    
        return $html;
    }
    
    public function renderActions($rowClass)
    {
        global $page;
        $html = '';
        foreach( $this->actions as $action => $data )      
        {
            $html .= '
                    <a href="'.App::getIns()->setAjaxLink($data['pointer'],$this->getHtmlID().'-'.$action).'?id='.$rowClass->{$this->getPrimaryKeyRaw()}.'" class="ui-state-default ui-corner-all dataGridAction '.$data['class'].'" title="'.$data["title_{$this->lang}"].'">
                        <span class="ui-icon '.$data['icon'].'"></span>
                    </a>';
            
        }
        
        return $html;
    }

    public function toHtml( $action, $addButton = true, $checkBoxActions = false )
    {
        $count = $this->count(true);
        $paging = self::paging( $count , array(
            'limit_period' => $this->PER_PAGE,
            'paging_show'  => 10,
            'limit' =>  isset($this->sortingFilters['limit']) ? $this->sortingFilters['limit'] : 0,
            'uri' => $action."?sorting=".$this->sortingFilters['sorting']."&amp;sortingCol=".$this->sortingFilters['sortingCol']
                            ));
            
            $optionsBar = $this->renderOptionsBar($checkBoxActions,$count);                
        
        $html = '<div class="dataGridPaging">'.$paging.'</div><br class="clear" />';
        $html.= (isset($this->filters['mode']) && $this->filters['mode'] == self::MODE_DEBUG ? 'SQL> '.$this->getSelect().'<br />':'');
        $html.= '
        <input type="hidden" name="dataGridColspan" value="'.$this->cellsCount($checkBoxActions).'" />
        <form class="dataGridFilters" action="'. $action .'" method="post">
        <input type="hidden" name="sorting" value="'.$this->sortingFilters['sorting'].'" />
        <input type="hidden" name="sortingCol" value="'.$this->sortingFilters['sortingCol'].'" />
        <input type="hidden" name="activePage" value="'.(isset($this->sortingFilters['limit']) ? $this->sortingFilters['limit'] : 0).'" />
       
        
        <table class="dataGridTable" border="0" cellspacing="0" cellpadding="0">
            ';
            $html .= $optionsBar;
            $html .= $this->head($addButton,$checkBoxActions);
            $html .= $this->body($checkBoxActions);
            if( !count($this->storage) )
            {
            $html .= '<tr>
                <td colspan="'.$this->cellsCount($checkBoxActions).'" class="dataGridData">'.$this->languagePack[$this->lang]['find_nothing'].'</td>
            </tr>';

            }
        
            $html .= $optionsBar;
            
        $html .= '</table> 
        
        </form>';
        $html .= '<div class="dataGridPaging">'.$paging.'</div><br class="clear" />';

        return $html;
    }

    public function cellsCount($checkBoxActions )
    {
        return 1 + count( $this->model ) + ($checkBoxActions ? 1 : 0);
    }
    
	public static function paging( $count, $params ) {
 
      $return = ''; 
      $current = 0;
      $items_per_page = $params['limit_period'];
      $show_items = $params['paging_show'];
      $active = $params['limit'];
      $uri    = $params['uri'];
      $href = 1;
      $forward = 0;
      $backward = 0;
      
      $uri_params = null;
      $bonus = null;
      /*
      $first = true;
      foreach( $params as $key => $value ):
       if( $first ) {
        if( $key != 'limit' && $key != 'uri' ) {       
         $uri_params .= '&amp;'.$key.'='.$value;
         $first = false; 
        }
	   } 
	   else {
	    if( $key != 'limit' && $key != 'uri' )  {     
	         $uri_params .= '&amp;'.$key.'='.$value; 
	    }
	   }              
	  endforeach;
          */
	  
      $uri_params = '?limit=';
      
      //first
      //prev show_items
      if(($active-($show_items/2)*$items_per_page) < 0) {
 			$bonus = ($active-($show_items/2)*$items_per_page);
      }
      if(($active+($show_items/2)*$items_per_page) >= $count) {
 			$bonus = (($active+($show_items/2)*$items_per_page)-$count);
      }
      do {
 		if($current >= ($active-(($show_items/2)*$items_per_page)-$bonus) && $current <= ($active+(($show_items/2)*$items_per_page)-$bonus)) {
	       $return .= '<a rel="'.$current.'" href="'.$uri. $uri_params . $current .'"
	                      class="ui-state-default '. ( $current == $active
	                           ? 'pagingActive' 
	                           : 'paging' ).
	                    '">&nbsp;'. $href .'&nbsp;</a> ';                       
		 }
		 if($current == $active) {
		  $forward = $current + ($items_per_page*5);
		  $backward = $current - ($items_per_page*5);
		 }
         $current += $items_per_page;
         $href++;     
       } while( $current < $count );
      
      $current -= $items_per_page;
      if($forward > $current) {
 		$forward = $current;
      }
      if($backward < 0) {
 		$backward = 0;
      }

$return = '<a  rel="0" href="'.$uri. $uri_params . 0 .'" class="ui-state-default paging"><span class="ui-icon ui-icon-arrowthickstop-1-w"><span>|&lt;</span></span></a>
                 <a  rel="'.$backward .'" href="'.$uri. $uri_params . $backward .'" class="ui-state-default paging"><span class="ui-icon ui-icon-arrowthick-1-w"><span>&lt;</span></span></a> '
                .$return;
      $return .= '<a rel="'.$forward .'" href="'.$uri. $uri_params . $forward .'" class="ui-state-default paging"><span class="ui-icon ui-icon-arrowthick-1-e"><span>&gt;</span></span></a> ';
      $return .= '<a rel="'.$current.'" href="'.$uri. $uri_params . $current .'" class="ui-state-default paging"><span class="ui-icon ui-icon-arrowthickstop-1-e"><span>&gt;|</span></span></a> ';
      if( $current % $items_per_page > 0 )
              $return .= '&nbsp;&nbsp; <a href="'. $uri.'?'. $uri_params . $current .'"
                      class="ui-state-default '. ( $params['paging'] == $active
                           ? 'active'
                           : 'paging' ).
                    '">'. $href .'</a>';


      //next show_items
      //last                           
                           
      return $return;

	}
        

     public static function renderDatetimeOperator( $value )
     {
         if( $value == "isBiggerOrEqual" ) return ">=";
         if( $value == "isBigger" ) return ">";
         if( $value == "isSmallerOrEqual" ) return "<=";
         if( $value == "isSmaller" ) return "<";
         
     }

     public function date2db($string)
     {
       if(  $this->lang == 'en' )
       {
         $date = explode("/",$string);

         return "{$date[2]}-{$date[0]}-{$date[1]}";
       }
       elseif( $this->lang == 'cz' )
       {
            $date = explode(".",$string);

         return "{$date[2]}-{$date[1]}-{$date[0]}";
       }
     }
     
     public function getJsFilters($endLine = "<br />") {
         $jsCode = "";
         foreach ($this->model as $collum => $data)
         {
             switch($data['filter'])
             {
                 
                 case "bit":
                     $jsCode .= "'{$collum}' : $( this.settings.jid + \" input[name='{$collum}']:checked\" ).val()," . $endLine;
                     break;
                 
                 case "select": 
                 case "text": 
                 case "key":
                     $jsCode .= "'{$collum}' : $( this.settings.jid + \"_{$collum}\" ).val()," . $endLine;
                     break;
                
                 case "datetime":
                 case "date":
                     $jsCode .= "'{$collum}' : $( this.settings.jid + \"_{$collum}\" ).val()," . $endLine;
                     $jsCode .= "'{$collum}_operator' : $( this.settings.jid + \"_{$collum}_operator\" ).val()," . $endLine;            
                    
                     $jsCode .= "'{$collum}_second' : $( this.settings.jid + \"_{$collum}_second\" ).val()," . $endLine;            
                     $jsCode .= "'{$collum}_operator_second' : $( this.settings.jid + \"_{$collum}_operator_second\" ).val()," . $endLine;            
                     
                     break;
                 
                 case "none":
                 default: break;
             }
            
         }
         
                                
            $jsCode .= "'sorting' : $(this.settings.jid + \" input[name='sorting']\").val()," . $endLine
                     . "'sortingCol' : $(this.settings.jid + \" input[name='sortingCol']\").val(),". $endLine
                     . "'limit' : $(this.settings.jid + \" input[name='activePage']\").val(),". $endLine
                     . "'showPerPage' : $(this.settings.jid + \" input[name='showPerPage']\").val()". $endLine
                    
                 ;
             
         
         return $jsCode;
     }

     public function modeAutocomplete($collum)
     {
                            
                             if( isset($this->model[ $collum ]["where"]) && $this->model[ $collum ]["where"] == '_custom' )
                                  $this->groupBy = $this->model[ $collum ]["custom_autoGroupBy"];
                            elseif( isset($this->model[ $collum ]["where"]) )
                                  $this->groupBy = "GROUP BY {$this->model[ $collum ]["where"]}";
                            elseif( isset($this->model[ $collum ]["table"]) )
                                  $this->groupBy = "GROUP BY `{$this->model[ $collum ]["table"]}`.`{$collum}`";
                            else
                                  $this->groupBy = "GROUP BY `{$collum}`";

                return "select ". implode( ', ', $this->collums ) . ' from ' . $this->table
						.' '. $this->where.' '. $this->groupBy
                                                .' '. $this->orderBy .
                                                $this->limit;

/*
                            if( isset($this->model[ $collum ]["where"]) )
                                  $replace = "DISTINCT({$this->model[ $collum ]["where"]}) as `{$collum}`";
                            elseif( isset($this->model[ $collum ]["table"]) )
                                  $replace = "DISTINCT(`{$this->model[ $collum ]["table"]}`.`{$collum}`) as `{$collum}`";
                            else
                                  $replace = "DISTINCT(`{$collum}`) as `{$collum}`";
                  
                            $new = array();
                            foreach( $this->collums as $key => $orig  )
                            {
                                if( preg_match("/(as {$collum})$/", $orig) || preg_match("/(as `{$collum}`)$/", $orig) )
                                {
                                    
                                    $new []= $replace;
                                    foreach( $this->collums as $key2 => $original )
                                    {
                                        if( $key == $key2 ) continue;
                                        $new []= $original;
                                    }
                                    break;
                                }
                            }
                            

                return "select ". implode( ', ', $new ) . ' from ' . $this->table
						.' '. $this->where.' '. $this->groupBy
                                                .' '. $this->orderBy .
                                                $this->limit;
*/
     }
     
     public function getHtmlID() {
         return $this->htmlID;
     }
     
     public function getActions() {
         return $this->actions;
     }
     
     public function getGroupActions() {
         return $this->checkBoxActions;
     }
}