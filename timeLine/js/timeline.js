
jQuery(document).ready(function($){
    var timelines = $('.cd-horizontal-timeline'),
        eventsMinDistance = 60;

    (timelines.length > 0) && initTimeline(timelines);

    function initTimeline(timelines) {
        timelines.each(function(){
            var timeline = $(this),
                timelineComponents = {};
            //cache timeline components
            timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
            timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
            timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
            timelineComponents['finllingsecLine'] = timelineComponents['eventsWrapper'].children('.filling-secline');
            timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
            timelineComponents['timelineVerticalNaviagtion'] = timeline.children('.timeline-nav');

            timelineComponents['verticalEvents'] = timelineComponents['timelineVerticalNaviagtion'].find('a');
            timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
            timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
            timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
            timelineComponents['eventsContent'] = timeline.children('.events-content');

            //assign a left postion to the single events along the timeline
            setDatePosition(timelineComponents, eventsMinDistance);
            //assign a width to the timeline
            var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
            //the timeline has been initialize - show it
            timeline.addClass('loaded');

            //detect click on the next arrow
            timelineComponents['timelineNavigation'].on('click', '.next', function(event){
                event.preventDefault();
                updateSlide(timelineComponents, timelineTotWidth, 'next');
                // showNewContent(timelineComponents, timelineTotWidth, 'next');
            });

            //detect click on the prev arrow
            timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
                event.preventDefault();
                updateSlide(timelineComponents, timelineTotWidth, 'prev');
                // showNewContent(timelineComponents, timelineTotWidth, 'prev');
            });

            //detect click on the a single event - show new event content
            timelineComponents['eventsWrapper'].on('click', 'a', function(event){
                event.preventDefault();
                timelineComponents['timelineEvents'].removeClass('selected');
                $(this).addClass('selected');
                updateOlderEvents($(this));
                updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
                updateVisibleContent($(this), timelineComponents['eventsContent']);

                //클릭한것 => .event 안의 a태그.
                var eventDate = $(this).data('date'),                 // 선택한 것의 날짜 key=date value => 변수 eventDate 에 저장. ex)2012/12/07
                    selectedContent = timelineComponents['timelineVerticalNaviagtion'].find('[data-date="'+ eventDate +'"]'); // 사이드 네비게이션에서 같은 날짜를 찾는다.
                    timelineComponents['verticalEvents'].removeClass('selected'); // 사이드 네비게이션 a태그의 클래스명에 'selected'를 지운다.
                    selectedContent.addClass('selected'); // 같은 날짜의 사이드 네비게이션 클래스 명에 'selected'를 붙여준다.
            });


            // detect click on the a side navigation event - show new event content //
            timelineComponents['timelineVerticalNaviagtion'].on('click','a',function(event){
              event.preventDefault();
              timelineComponents['verticalEvents'].removeClass('selected');
              $(this).addClass('selected');

              var eventDate = $(this).data('date'),                 // 선택한 것의 날짜 key=date value => 변수 eventDate 에 저장. ex)2012/12/07
                  selectedContent = timelineComponents['eventsWrapper'].find('[data-date="'+ eventDate +'"]'); // 타임라인에서 같은 날짜를 찾는다.
                  timelineComponents['timelineEvents'].removeClass('selected'); // 타임라인 a태그의 클래스명에 'selected'를 지운다.
                  selectedContent.addClass('selected'); // 같은 날짜의 타임라인의 클래스 명에 'selected'를 붙여준다.
                  // findContent = timelineComponents['eventsWrapper'].find('a.selected');

              updateOlderEvents(selectedContent);
              updateFilling(selectedContent,timelineComponents['fillingLine'], timelineTotWidth);
              updateVisibleContent(selectedContent, timelineComponents['eventsContent']);
            });

            //on swipe, show next/prev event content
            timelineComponents['eventsContent'].on('swipeleft', function(){
                var mq = checkMQ();
                ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
            });
            timelineComponents['eventsContent'].on('swiperight', function(){
                var mq = checkMQ();
                ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
            });

            //keyboard navigation
            $(document).keyup(function(event){
                if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
                    showNewContent(timelineComponents, timelineTotWidth, 'prev');
                } else if( event.which=='39' && elementInViewport(timeline.get(0))) {
                    showNewContent(timelineComponents, timelineTotWidth, 'next');
                }
            });
        });
    }

    function updateSlide(timelineComponents, timelineTotWidth, string) {
        //retrieve translateX value of timelineComponents['eventsWrapper']
        var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
            wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
        //translate the timeline to the left('next')/right('prev')
        (string == 'next')
            ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
            : translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
    }

    function showNewContent(timelineComponents, timelineTotWidth, string) {
        //go from one event to the next/previous one
        var visibleContent =  timelineComponents['eventsContent'].find('.selected'),  //기존에 셀렉 되어있는것 컨텐츠.
            newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev(); //다음 버튼이면 기존 셀렉되어있는 컨텐츠 다음 컨텐츠로 아니면 이전거로.

        //클릭한것 => .event 안의 a태그.
        var eventDate = newContent.data('date'),                 // 새로 선택한 것의 날짜 key=date value => 변수 eventDate 에 저장. ex)2012/12/07
              selectedContent = timelineComponents['timelineVerticalNaviagtion'].find('[data-date="'+ eventDate +'"]'); // 사이드 네비게이션에서 같은 날짜를 찾는다.
              timelineComponents['verticalEvents'].removeClass('selected'); // 사이드 네비게이션 a태그의 클래스명에 'selected'를 지운다.
              selectedContent.addClass('selected'); // 같은 날짜의 사이드 네비게이션 클래스 명에 'selected'를 붙여준다.

        if ( newContent.length > 0 ) { //if there's a next/prev event - show it
            var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),  //사이드 바 selected 찾기.
                // selectedNav = timelineComponents['timelineVerticalNaviagtion'].find('.selected'), //네비에서 selected찾기.
                newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a'); //가로 타임라인과 사이드 네비의 a태그에 selected가 있기 때문에 넥스트요청시 그 부모 li태그의 다음 li태그를 찾고 그 안의 a태그를 검색한다. 프리브요청시 그 반대.
                // newNavEvent = ( string = 'next') ? selectedNav.parent('li.nav-sub').next('li.nav-sub').children('a') : selectedNav.parent('li.nav-sub').prev('li.nav-sub').children('a');

            updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
            updateVisibleContent(newEvent, timelineComponents['eventsContent']);
            selectedDate.removeClass('selected'); //타임라인 셀렉트 클래스 명 제거.
            // selectedNav.removeClass('selected');  //사이드 바 클래스 명 제거.
            newEvent.addClass('selected');        //새로 찾은 타임라인 a태그 셀렉트 추가.
            // newNavEvent.addClass('selected');     //새로 찾은 사이드 네비 a태그 셀렉트 추가.
            updateOlderEvents(newEvent);
            // updateOlderEvents(newNavEvent);
            updateTimelinePosition(string, newEvent, timelineComponents, timelineTotWidth);

        }
    }

    function updateTimelinePosition(string, event, timelineComponents, timelineTotWidth) {
        //translate timeline to the left/right according to the position of the selected event
        var eventStyle = window.getComputedStyle(event.get(0), null),
            eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
            timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
            timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
        var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

        if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
            translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
        }
    }

    function translateTimeline(timelineComponents, value, totWidth) {
        var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
        value = (value > 0) ? 0 : value; //only negative translate value
        value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
        setTransformValue(eventsWrapper, 'translateX', value+'px');
        //update navigation arrows visibility
        (value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
        (value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
    }


    function updateFilling(selectedEvent, filling, totWidth) {
        //change .filling-line length according to the selected event
        var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
            eventLeft = eventStyle.getPropertyValue("left"),
            eventWidth = eventStyle.getPropertyValue("width");
        eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
        var scaleValue = eventLeft/totWidth;
        setTransformValue(filling.get(0), 'scaleX', scaleValue);
    }

    function setDatePosition(timelineComponents, min) {
        for (i = 0; i < timelineComponents['timelineDates'].length; i++) {
            var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
                distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
            timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
        }
    }

    function setTimelineWidth(timelineComponents, width) {
        var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
            timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
            timeSpanNorm = Math.round(timeSpanNorm) + 4,
            totalWidth = timeSpanNorm*width;
        timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
        updateFilling(timelineComponents['timelineEvents'].eq(0), timelineComponents['fillingLine'], totalWidth);

        return totalWidth;
    }

    function updateVisibleContent(event, eventsContent) {  //(선택한것, 제일 큰 컨텐트)
        var eventDate = event.data('date'),                 // 선택한 것의 날짜 key=date value => 변수 eventDate 에 저장.
            visibleContent = eventsContent.find('.selected'), //전체에서 selected 를 찾는다.
            selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'), // 전체에서 선택된 날짜를 찾는다.
            selectedContentHeight = selectedContent.height(); //선택된 컨텐츠 높이.


        if (selectedContent.index() > visibleContent.index()) {
            var classEnetering = 'selected enter-right',
                classLeaving = 'leave-left';
        } else {
            var classEnetering = 'selected enter-left',
                classLeaving = 'leave-right';
        }

        selectedContent.attr('class', classEnetering);
        visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
            visibleContent.removeClass('leave-right leave-left');
            selectedContent.removeClass('enter-left enter-right');
        });
        eventsContent.css('height', selectedContentHeight+150+'px');
    }

    function updateOlderEvents(event) {
        event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
    }

    function getTranslateValue(timeline) {
        var timelineStyle = window.getComputedStyle(timeline.get(0), null),
            timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                timelineStyle.getPropertyValue("-moz-transform") ||
                timelineStyle.getPropertyValue("-ms-transform") ||
                timelineStyle.getPropertyValue("-o-transform") ||
                timelineStyle.getPropertyValue("transform");

        if( timelineTranslate.indexOf('(') >=0 ) {
            var timelineTranslate = timelineTranslate.split('(')[1];
            timelineTranslate = timelineTranslate.split(')')[0];
            timelineTranslate = timelineTranslate.split(',');
            var translateValue = timelineTranslate[4];
        } else {
            var translateValue = 0;
        }

        return Number(translateValue);
    }

    function setTransformValue(element, property, value) {
        element.style["-webkit-transform"] = property+"("+value+")";
        element.style["-moz-transform"] = property+"("+value+")";
        element.style["-ms-transform"] = property+"("+value+")";
        element.style["-o-transform"] = property+"("+value+")";
        element.style["transform"] = property+"("+value+")";
    }

    //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
    function parseDate(events) {
        var dateArrays = [];
        events.each(function(){
            var dateComp = $(this).data('date').split('/'),
                newDate = new Date(dateComp[2], dateComp[1]-1, dateComp[0]);
            dateArrays.push(newDate);
        });
        return dateArrays;
    }

    function parseDate2(events) {
        var dateArrays = [];
        events.each(function(){
            var singleDate = $(this),
                dateComp = singleDate.data('date').split('T');
            if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
                var dayComp = dateComp[0].split('/'),
                    timeComp = dateComp[1].split(':');
            } else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
                var dayComp = ["2000", "0", "0"],
                    timeComp = dateComp[0].split(':');
            } else { //only DD/MM/YEAR
                var dayComp = dateComp[0].split('/'),
                    timeComp = ["0", "0"];
            }
            var newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
            dateArrays.push(newDate);
        });
        return dateArrays;
    }

    function daydiff(first, second) {
        return Math.round((second-first));
    }

    function minLapse(dates) {
        //determine the minimum distance among events
        var dateDistances = [];
        for (i = 1; i < dates.length; i++) {
            var distance = daydiff(dates[i-1], dates[i]);
            dateDistances.push(distance);
        }
        return Math.min.apply(null, dateDistances);
    }

    /*
        How to tell if a DOM element is visible in the current viewport?
        http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
    */
    function elementInViewport(el) {
        var top = el.offsetTop;
        var left = el.offsetLeft;
        var width = el.offsetWidth;
        var height = el.offsetHeight;

        while(el.offsetParent) {
            el = el.offsetParent;
            top += el.offsetTop;
            left += el.offsetLeft;
        }

        return (
            top < (window.pageYOffset + window.innerHeight) &&
            left < (window.pageXOffset + window.innerWidth) &&
            (top + height) > window.pageYOffset &&
            (left + width) > window.pageXOffset
        );
    }

    function checkMQ() {
        //check if mobile or desktop device
        return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
    }
});
