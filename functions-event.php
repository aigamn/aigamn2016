<?php

	add_action( 'init', 'create_event_post_types' );
	function create_event_post_types() {
		register_post_type( 'event',
			[
				'labels' => [
					'name' => __( 'Events' ),
					'singular_name' => __( 'Event' )
				],
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => [
					'title',
					'editor',
					'thumbnail',
					'author',
					'comments'
				],
			]
		);
		register_post_type( 'conference',
			[
				'labels' => [
					'name' => __( 'Conferences' ),
					'singular_name' => __( 'Conference' )
				],
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => [
					'title',
					'editor',
					'thumbnail',
					'author',
					'comments'
				],
			]
		);
		register_post_type( 'conference_event',
			[
				'labels' => [
					'name' => __( 'Conference Events' ),
					'singular_name' => __( 'Conference Event' )
				],
				'public' => true,
				'has_archive' => true,
				'menu_position' => 5,
				'supports' => [
					'title',
					'editor',
					'thumbnail',
					'author',
					'comments'
				],
			]
		);
		register_taxonomy(
			'recurring',
			['conference', 'event'],
			[
				'label' => __( 'Recurring' ),
				'hierarchical' => true,
				'show_ui' => true,
				'capabilities' => [
		            'manage_terms' => 'edit_posts', // means administrator', 'editor', 'author', 'contributor'
		            'edit_terms' => 'edit_posts',
		            'delete_terms' => 'edit_posts',
		            'assign_terms' => 'edit_posts'
	            ]
            ]
		);
	}

	function getFriendlyDateRange($startDateTime, $endDateTime){
		$tense = getEventTense($startDateTime, $endDateTime);
		$currentTime = time();

		$dayAndMonthSame = $daySame && $monthSame;
		$dateSame = $daySame && $monthSame && $yearSame;

		// find out if month, day,
		if($tense == 'past'){
			$formattedDate = 'Ended ' . date("M jS, o", $endDateTime);
		}
		else{
			$startDay = date("j", $startDateTime);
			$startMonth = date("m", $startDateTime);
			$startYear = date("o", $startDateTime);
			$endDay = date("j", $endDateTime);
			$endMonth = date("m", $endDateTime);
			$endYear = date("o", $endDateTime);

			$daySame = $startDay == $endDay;
			$monthSame = $startMonth == $endMonth;
			$yearSame = $startYear == $endYear;

			if(!$yearSame){
				// Jan 4th 2016, 6:00pm - Jan 4th 2017, 4:00pm
				$formattedDate = date("D, M jS o, g:ia", $startDateTime) . ' - ' . date("D, M jS o, g:ia",  $endDateTime);
			}
			else{
				if(!$monthSame){
					// Jan 30th, 6:00pm - Feb 1st, 1:00am, 2016
					$formattedDate = date("D, M jS, g:ia", $startDateTime) . ' - ' . date("D, M jS, g:ia, o", $endDateTime);
				}
				else{
					if(!$daySame){
						// Feb 20th, 1:15pm - Feb 21st, 2:55pm, 2016
						$formattedDate = date("D, M jS, g:ia", $startDateTime) . ' - ' . date("D, M jS, g:ia, o", $endDateTime);
					}
					else{
						// Feb 20th, 1:15pm - 2:55pm, 2016
						$formattedDate = date("D, M jS, g:ia", $startDateTime) . ' - ' . date("g:ia, o", $endDateTime);
					}
				}

				if($tense == 'present'){
					$formattedDate = 'Happening Now: ' . $formattedDate;
				}
			}
		}

		return $formattedDate;
	}

	function getGroups($postId) {
		$groups = get_field('group', $postId);
		return $groups;
	}

	function isRecurringEvent($postId){
		$recurringEvent = get_the_terms($postId, 'recurring');
		if($recurringEvent != "") {
			return true;
		}
		return false;
	}

	function getEventTense($eventStartTime, $eventEndTime){
		$currentTime = time();
		// check present
		if($currentTime > $eventStartTime && $currentTime < $eventEndTime){
			return 'present';
		}
		if ($currentTime < $eventStartTime) {
			return 'future';
		}
		if ($currentTime > $eventEndTime) {
			return 'past';
		}
		return 'Logic incorrect';
	}

	function getRecurringEventName($postId) {
		$recurringEvent = get_the_terms($postId, 'recurring');
		if($recurringEvent){
			foreach($recurringEvent as $event) {
				return $event->name;
			}
		}
		return false;
	}

	function getNextRecurringEventLink($postId, $date) {
		$recurringEvent = get_the_terms($postId, 'recurring');
		foreach($recurringEvent as $event) {
			$slug = $event->slug;
		}
		$args = [
			'post_type' => ['event', 'conference'],
			'tax_query'=> [
				[
					'taxonomy'=>'recurring',
					'field'=>'slug',
					'terms'=>$slug,
				],
			],
		];
		
		$query = new WP_Query($args);
		$returnedPosts = $query->posts;

		foreach($returnedPosts as $returnedPost) {
			$postStartTime = get_field('start_time', $returnedPost->ID);
			if($postStartTime > time()) {
				$nextRecurringEventLink = get_permalink($returnedPost->ID);
				return $nextRecurringEventLink;
			}
		}
	}

	function getUpcomingEvents($number = 0) {
		$time = time();
		$args = [
			'post_type'	=> ['event', 'conference'],
			'meta_query' => [
				'endtime_clause' => [
					[
						'key' => 'end_time',
						'value' => $time,
						'compare' => '>',
					],
				],
				'starttime_clause' => [
					[
						'key' => 'start_time',
						'compare' => 'EXISTS',
					],
				],
			],
			'orderby' => [
				'starttime_clause' => 'ASC',
				'endtime_clause' => 'ASC'
			]
		];
		if($number > 0) {
			$args['posts_per_page'] = $number;
		}
		$query = new WP_Query($args);
		return $query;
	}

	function getUpcomingGroupEvents($number = 0) {
		$time = time();
		$args = [
			'post_type'	=> ['event', 'conference'],
			'meta_query' => [
				'endtime_clause' => [
					[
						'key' => 'end_time',
						'value' => $time,
						'compare' => '>',
					],
				],
				'starttime_clause' => [
					[
						'key' => 'start_time',
						'compare' => 'EXISTS',
					],
				],
				'group_clause' => [
					[
						'key' => 'group',
						'value' => '',
						'compare' => '!=',
					],
					[
						'key' => 'group',
						'value' => 'null',
						'compare' => '!=',
					],
				],
			],
			'orderby' => [
				'starttime_clause' => 'ASC',
				'endtime_clause' => 'ASC'
			]
		];
		if($number > 0) {
			$args['posts_per_page'] = $number;
		}
		$query = new WP_Query($args);
		return $query;
	}

	function getUpcomingEventsByGroup($groupPostId, $number = 0) {
		$args = [
			'post_type'	=> ['event', 'conference'],
			'meta_query'		=> [
				'endtime_clause' => [
					[
						'key' => 'end_time',
						'value' => $time,
						'compare' => '>',
					],
				],
				'starttime_clause' => [
					[
						'key' => 'start_time',
						'compare' => 'EXISTS',
					],
				],
				'group_clause' => [
					[
						'key'    	=> 'group',
						'value'		=> $groupPostId,
						'compare'	=> '=',
					],
				]
			],
			'orderby' => [
				'starttime_clause' => 'ASC',
				'endtime_clause' => 'ASC'
			]
		];
		if($number > 0) {
			$args['posts_per_page'] = $number;
		}
		$query = new WP_Query($args);
		return $query;
	}

	function getUpcomingNonGroupEvents($number = 0) {
		$time = time();
		$args = [
			'post_type'	=> ['event', 'conference'],
			'meta_query'		=> [
				'endtime_clause' => [
					[
						'key' => 'end_time',
						'value' => $time,
						'compare' => '>',
					],
				],
				'starttime_clause' => [
					[
						'key' => 'start_time',
						'compare' => 'EXISTS',
					],
				],
					[
						'relation' => 'OR', 
						[
							'key'    	=> 'group',
							'value'		=> '',
							'compare'	=> '=',
						],
						[
							'key'    	=> 'group',
							'value'		=> 'null',
							'compare'	=> '=',
						],
					],
			],
		];
		if($number > 0) {
			$args['posts_per_page'] = $number;
		}
		$query = new WP_Query($args);
		return $query;
	}

	function getConferenceEvents($conferenceId){
		$time = time();
		$args = [
			'post_type'	=> ['conference_event'],
			'meta_query'		=> [
				'endtime_clause' => [
					[
						'key' => 'end_time',
						'compare' => 'EXISTS',
					],
				],
				'starttime_clause' => [
					[
						'key' => 'start_time',
						'compare' => 'EXISTS',
					],
				],
				'conference_clause' => [
					[
						'key' => 'conference',
						'compare' => '=',
						'conferenceId' => $conferenceId
					],
				],
				'orderby' => [
					'starttime_clause' => 'ASC',
					'endtime_clause' => 'ASC',
				]
			],
		];
		if($number > 0) {
			$args['posts_per_page'] = 0;
		}
		$query = new WP_Query($args);
		return $query;
	}

	function getPastEvents() {
		$time = time();
		$args = [
			'post_type'			=> ['event', 'conference'],
			'meta_key'     	=> 'end_time',
			'meta_value'   	=> $time,
			'meta_compare' 	=> '<',
		];
		$query = new WP_Query($args);
		return $query;
	}

?>
