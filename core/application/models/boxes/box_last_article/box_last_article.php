<?php
class box_last_article extends CI_Model
{
	public function initialize(){
		$count = $this->boxes_model->configuration_kay('COUNT_LAST_ARTICLE');
		$where = "archive ='0' and publish_up <= '".adate(4).date('His')."'and publish_down >= '".adate(4)."'";
		$LastArticle = $this->lib_database->limit('article',$where,$count,NULL,'publish_up','DESC');

		   	$return = '<div class="panel panel-default text-right dir-rtl">';
			$return .= '<div class="panel-heading">';
			$return .= '<label class="panel-text">آخرین مطالب</label>';
			$return .= '</div>';
			$return .= '<div class="panel-body">';
			$return .= "<div class='list-group'>";
			foreach ($LastArticle as $row){
			$return .="<a class='list-group-item' href='".site_url('summary'.'/'.rawurlencode(str_replace(' ','-',urldecode($row->title))))."'>".$row->title."</a>";
				}
			$return .="</div>";					
			$return .='</div>';
			$return .= '</div>';

		return $return;	
	}
	
	public function model_install(){
		
		/*
		* نمونه کد ها برای شبیح سازی تگ های اچ تی ام ال
		* text_value() = <input type="text" /> 
		* textarea_value() = <textarea></textarea>
		* select_option() = <select></select>
		*/
		
		/* 
		* مقدار دهی برای فیلد  انتخابی      
		* text_value() = a-blog
		* textarea_value() = a-blog
		* select_option() = 1,2,3,4
		*/
		
		
		/*
		* اگر فقت یک فیلد دارید باید از این کد استفاده کنید
		* $return = array (array('title'=>'لیست دوستان',
		*		  'kay'=>'COUNT_FRIEND_LIST',
		*		  'value'=>'10',
		*		  'description'=>'تعداد دوستان قابل نمایش',
		*		  'box_name'=>'BOX_FRIENDS_LIST',
		*		  'use_input'=>'text_value()',
		*		  'set_input_value'=>'10'));
		*/
		
		
		/*
		* برای اضافه کردن چندین مقدار از کد زیر استفاده کنید
		* $return = array (
		*					array('title'=>'لیست دوستان',
		*		  				'kay'=>'COUNT_FRIEND_LIST',
		*		  				'value'=>'10',
		*		  				'description'=>'تعداد دوستان قابل نمایش',
		*		  				'box_name'=>'BOX_FRIENDS_LIST',
		*		  				'use_input'=>'text_value()',
		*		  				'set_input_value'=>'10'),
		*					array('title'=>'لیست دوستان',
		*		  				'kay'=>'COUNT_FRIEND_LIST',
		*		  				'value'=>'10',
		*		  				'description'=>'تعداد دوستان قابل نمایش',
		*		  				'box_name'=>'BOX_FRIENDS_LIST',
		*		  				'use_input'=>'text_value()',
		*		  				'set_input_value'=>'10')
		*					);
		*/
		
		$return = array (array('title'=>'آخرین مطالب ثبت شده',
						'kay'=>'COUNT_LAST_ARTICLE',
						'value'=>'10',
						'description'=>'تعداد مطالب قابل نمایش',
						'box_name'=>'BOX_LAST_ARTICLE',
						'use_input'=>'text_value()',
						'set_input_value'=>''));
						
		return $return;
		}
		
	public function configuration_install(){
			
		}	
	
}

  