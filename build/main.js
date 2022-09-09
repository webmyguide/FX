$(function () {

  var breakpoints = {
    'sm': 480,
    'md': 768,
    'lg': 1000
  };

  var w_window = $(document).width();

  /* ==================================================================================
     		pageTop
　   ================================================================================== */
    // var hDocument = $(document).height();
    // var hWindow = $(window).height();
    // var pagetopSelector = $('#buttonPagetop');

    //スクロールしてトップ
    $(document).on('click','#buttonPagetop',function(){
        $('body,  html').animate({
            scrollTop: 0
        },   500);
        return false;
    });


    var speed = 500;
    var urlHash = location.hash;
    if(urlHash) {
        $('body,html').stop().scrollTop(0);
        setTimeout(function(){
            let w_window = $(document).width();
            var target = $(urlHash);
            var nav_h = $('#pageHeader').height();
            if(!nav_h) nav_h = 82;
            if(w_window >= breakpoints['md']){
                var position = target.offset().top - nav_h - 10;
            }else {
                var position = target.offset().top - nav_h;
            }
            $('body,html').stop().animate({scrollTop:position}, 500);
        }, 100);
    }
    $(document).on('click','a[href^="#"]',function(){
        let w_window = $(document).width();
        var href= $(this).attr('href');
        var url = location.protocol + '//' + location.hostname + location.pathname;
        href = href.replace(url, '');
        var target = $(href == '#' || href == '' ? 'html' : href);

        // if( target.size() < 1 ) return true;
        var nav_h = $('#pageHeader').height();
        if(!nav_h) nav_h = 82;

        if(w_window >= breakpoints['md']){

            var position = target.offset().top - nav_h - 10;
        }else {
            var position = target.offset().top - nav_h;
        }

        $('html, body').animate({scrollTop:position}, speed, 'swing');
        return false;
    });


    /* ==================================================================================
        アコーディオン
    ================================================================================== */
    if($('[data-acd-search-trigger]').length > 0){
        var acd_search_trigger = $('[data-acd-search-trigger]');
        for (var i = 0; i < acd_search_trigger.length; i++) {
            acd_search_trigger.eq(i).attr('data-acd-search-trigger',i+1);
            acd_search_trigger.eq(i).parent().find('[data-accordion-search]').attr('data-accordion-search',i+1);
            if(w_window >= breakpoints['md']){
                acd_search_trigger.eq(i).parent().find('[data-accordion-search]').css('display','block');
            }
        }
    }

    $(document).on("click",'[data-acd-search-trigger]', function(){
      let self = this;
      let acd_id = $(self).attr('data-acd-search-trigger');
      let target = $('[data-accordion-search="' + acd_id + '"]');

      $(self).toggleClass('on');
      target.slideToggle();
      // if(target.css('display') == 'none'){
      //   target.show();
      // }else {
      //   target.hide();
      // }
    });

  /* ==================================================================================
     		高さをそろえる
  	　================================================================================== */
  	/**
  	 *
  	 * data-heightidでグループ化されているもので高さをそろえる
  	 * data-heightid number
  	 *
  	 */
  	//初期表示
  	alignHeights();

  	//サイズが変更されたとき
  	$(window).resize(function() {
  	    alignHeights();
  	});


  	/**
  	 * 高さをそろえる処理
  	 */
  	 function alignHeights(){
  		 //指定データーカスタムの数取得
  		 var targetCount = $('[data-heightid]').length;

  		 //指定データーカスタムがない場合は何もしない
  		 if(targetCount <= 0){
  			 return false;
  		 }

       //スマホなら高さをそろえない
       var wWindow = $(document).width();
       if(breakpoints['sm'] > wWindow){
         $('[data-heightid]').css('height','auto');
         return false;
       }

  		 //各セクションごとの高さを合わせる
  		 var currentId,currentHeight = 0;
  		 var dataRedult = {};
  		 for(var i = 0; i < targetCount; i++ ){
  			 var targetSelector = $('[data-heightid]').eq(i);
  			 var targetId = targetSelector.attr('data-heightid');

  			 //heightをリセット
  			 targetSelector.css('height','');

  			 //heightを取得
  			 var targetHeght = targetSelector.outerHeight();

  			 //currentIdとtargetIdが違う場合はobjectに新しいkeyを追加
  			 if(currentId != targetId){
  				 dataRedult[targetId] = '';
  				 currentId = targetId;
  				 //currentHeightリセット
  				 currentHeight = 0;
  			 }


  			 //前回より今回の方が高ければ高さをセット
  			 if(currentHeight < targetHeght){
  				 currentHeight = targetHeght;
  				 dataRedult[targetId] = currentHeight;
  			 }
  		 }

  		 //結果を反映
  		 for (var key in dataRedult) {
  		  	$('[data-heightid="' + key + '"]').css('height',dataRedult[key]);
  		}
  	 }

     /* ==================================================================================
        		登録者数のセット
     	　================================================================================== */
      if($('[data-num-registrants]').length > 0){
        getNumberRegistrants();
      }


     /* ==================================================================================
        		登録者数の取得
     	　================================================================================== */
      function getNumberRegistrants() {
        //ajax用dataをセット
        var ajaxData = {
              "action": "ajaxNumberRegistrants",
        };

        //ajax基本処理
         var jqXHR =  $.ajax(ajaxUrl, {
            "type": "post",
            "data": ajaxData,
            "timeout":  2000
        });

        //ajax成功
        jqXHR.done(function(data, textStatus, jqXHR){
          // console.log('通信成功');
          // console.log(data);
          var numRagSelector = $('[data-num-registrants]');

          numRagSelector.attr('data-num-registrants',data);
          var result = data.substr( -1 );
          var result = data.substr( 0 );

          list = numSubstr(data);


          numRagSelector.find('.fixedNum').text(list[0]);
          numRagSelector.find('.cagNum').text(list[1]);


          var countElm = numRagSelector.find('.cagNum').eq(0),
              countSpeed = 30;

                var self = countElm,
                countTimer1,countTimer2;

                function timer1(){

                }

                function timer2(){
                    var allCount = Number(numRagSelector.attr('data-num-registrants'));
                    var cahThisCount = self.text();
                    var countNext = cahThisCount;
                    var random = Math.floor(Math.random()*3 + 1);
                    var cahAllCount = allCount;
                    if(random == 2){
                      cahAllCount = Number(allCount)+1;
                    }else if (random == 1) {
                      cahAllCount = Number(allCount)-1;
                    }

                    if( (cahAllCount == allCount) || (cahAllCount < 1) )return false;

                    listCount = numSubstr(cahAllCount);
                    numRagSelector.find('.fixedNum').text(listCount[0]);
                    numRagSelector.attr('data-num-registrants',cahAllCount);
                    var countMax = Number(listCount[1])+11;

                    var timerCount2 = 0;
                    countTimer2 = setInterval(function(){
                      var numNext = countNext++;
                          result = String(numNext).substr(-1,1);
                          numRagSelector.find('.cagNum').text(result);
                          if( (countNext == countMax) || (timerCount2 > 20) ){
                              clearInterval(countTimer2);
                          }
                          timerCount2++;
                    },countSpeed);

                    //フォーカスが外れたらタイマーを解除
                    $(window).on("blur",function(){
                      clearInterval(countTimer2);
                    })
                };

                var timerCount1 = 0;
                countTimer1 =setInterval(function(){
                  timer2();
                  if( (timerCount1 > 20) ){
                    clearInterval(countTimer1);
                  }
                  timerCount1++;
                },3000);

                //フォーカスが外れたらタイマーを解除
                $(window).on("blur",function(){
                  clearInterval( countTimer1);
                })

        });

        //ajax失敗
        jqXHR.fail(function(jqXHR, textStatus, errorThrown){
            // console.log('通信失敗');
            $('[data-num-registrants]').text(30);
         });
      }

      function numSubstr(count) {
        var strCount = String(count);
        var list = [];
        for(var i = 0;i < strCount.length;i++){
          if(count < 10){
            list[0] = '';
            list[1] = strCount.substr( i,1 );
          }else {
            if((i +1) == strCount.length){
              list[1] = strCount.substr( i,1 );
            }else if(i == 0) {
              list[0] = strCount.substr( i,1 );
            }else {
              list[0] = String(list[0]) + strCount.substr( i,1 );
            }
          }

        }
        return list;
      }

     /* ==================================================================================
        		＋こだわり条件を追加
     	　================================================================================== */
      $(document).on("click",'#tggleInput', function(){
        var self = this;
        var initialHideSelector = $('.box-form').find('.initial-hide');
        if(initialHideSelector.css('display') == 'none'){
          initialHideSelector.show();
          $(self).text('－こだわり条件を削除');
        }else {
          initialHideSelector.hide();
          $(self).text('＋こだわり条件を追加');
        }
      });

      /* ==================================================================================
         		メニュー
      	　================================================================================== */
        //サイズが変更されたとき
       $(document).on("click",'#onMenu', function(){
         var self = this;
         var hHeader = $('header').height();
         var hWpadminbar = $('#wpadminbar').height() || 0;
         var hWindow = $(document).height();
         var targetSelector = $('#targetMenu');

         if(targetSelector.hasClass('headerMenu-on')){
             targetSelector.removeClass('headerMenu-on');
             $('.header__menu').removeClass('header__menu-on');
         }else {
             targetSelector.addClass('headerMenu-on');
             $('.header__menu').addClass('header__menu-on');
         }
       });


    /* ==================================================================================
    並び替え
    ================================================================================== */
     sortProduct();
     function sortProduct(){
        //  パラメータを取得
        var url_param = location.search.substring(1);
        var param_array = [];
        if( url_param ) {
            var param = url_param.split('&');
            for (i = 0; i < param.length; i++) {
                var param_item = param[i].split('=');

                //複数選択の場合
                idx = param_item[0].indexOf("%5B%5D");
                if(idx != -1) {
                    var key = param_item[0].replace( "%5B%5D", "" );
                    if(param_array[key]){
                        num++;
                        param_array[key][num] = param_item[1];
                    }else {
                        var num = 0;
                        param_array[key] = [];
                        param_array[key][num] = param_item[1];
                    }
                }else {
                    param_array[param_item[0]] = param_item[1];
                }
            }
        }

        var processing_sort = false;
        $(document).on("click",'[data-sort-product] a', function(){
            var self = this;

            //処理中のフラグ判定
            if(processing_sort === true) return false;
            processing_sort = true;

            //sortタイプの取得
            var sort_page = $(self).parents('[data-sort-product]').attr("[data-sort-page]");

            //isReputationの取得
            var dateWhere = $( self ).attr('data-where');
            var dateOrder = $( self ).attr('data-order');

            //selectのリセット
            $(self).parents('[data-sort-product]').find('.btnSort').removeClass('select');

            //selectのセット
            $(self).addClass('select');

           //固定のorderがある場合
           if(sort_page == 'search'){
               var ajaxData = {
                     "action": "ajax_sort_product",
                     "sk1": param_array.sk1,
                     "sk2": param_array.sk2,
                     "sk3": param_array.sk3,
                     "sk4": param_array.sk4,
                     "sk5": param_array.sk5,
                     "order": dateOrder,
                     "where": dateWhere,
                     "page": sort_page
               };
           }else {
               var ajaxData = {
                     "action": "ajax_sort_product",
                     "order": dateOrder,
                     "where": dateWhere,
                     "page": ''
               };
           }


           //ajax用dataをセット
           var jqXHR =  $.ajax(ajaxUrl, {
               "type": "post",
               "data": ajaxData,
               "timeout":  20000
           });

            //ajax成功
            jqXHR.done(function(data, textStatus, jqXHR){
                // console.log('通信成功');
                // console.log(data);

                //sortタイプの取得
                let target_content = $('[data-sort-content]');
                let obj = JSON.parse(data);

                //案件を取得
                let product = '';
                Object.keys(obj).forEach(function (key) {
                    let selector = target_content.find('[data-sort-id="' + obj[key]['id'] + '"]');
                    if(selector.length > 0){
                        product += selector.prop('outerHTML');
                    }
                });


                //where,orderの取得
                target_content.empty().append('読み込み中...');

                setTimeout(function(){
                    //取得した記事を表示
                    target_content.empty().append(product);
                    processing_sort = false;
                }, 700);
            });

           //ajax失敗
           jqXHR.fail(function(jqXHR, textStatus, errorThrown){
               // console.log('通信失敗');
               alert('取得に失敗しました、もう一度お試し下さい。');
               processing_sort = false;
            });
       });

     }

    /* ==================================================================================
    該当件数
    ================================================================================== */
    if( $('[data-search-hits]').length > 0 ){
        for (var i = 1; i <= $('[data-search-hits]').length; i++) {
            $('[data-search-hits]').eq(i-1).attr('data-search-hits', i);
            search_hits(i);
        }

        $(document).on("click",'input', function(){
            let self = this;
            let type = $(self).attr('type');
            if( type == 'submit' ) return;

            let id = $(self).parents('[data-search-hits]').attr('data-search-hits');
            search_hits(id);
        });
    }



    function search_hits(id){
        let form_search = $('[data-search-hits="' + id + '"]');

        let list_input = [];
        for (var i = 0; i < form_search.find('.itemsHits').length; i++) {
            list_input[i] = {
                'type': form_search.find('.itemsHits').eq(i).find('input').eq(0).attr('type'),
                'name': form_search.find('.itemsHits').eq(i).find('input').eq(0).attr('name')
            }
        }

        //
        var ajaxData = {
            "action": "ajax_search_hits",
            "id": id
        };

        Object.keys(list_input).forEach(function (key) {
            if(list_input[key]['type'] == 'checkbox'){
                var ajax_key = list_input[key]['name'].replace('[]','');
                var ajax_value = [];
                form_search.find('input:checkbox[name="' + list_input[key]['name'] + '"]:checked').each(function() {
        			ajax_value.push($(this).val());
        		});
            }else {
                var ajax_key = list_input[key]['name'];
                var ajax_value = '';
                ajax_value = form_search.find('input:radio[name="' + list_input[key]['name'] + '"]:checked').val();
            }

            ajaxData[ajax_key] = ajax_value;
        });


        //ajax用dataをセット
        var jqXHR =  $.ajax(ajaxUrl, {
            "type": "post",
            "data": ajaxData,
            "timeout":  20000
        });

        //ajax成功
        jqXHR.done(function(data, textStatus, jqXHR){
            // console.log('通信成功');
            // console.log(data);
            let obj = JSON.parse(data);

            let form_search = $('[data-search-hits="' + obj['id'] + '"]');
            form_search.find('[data-hits-target]').attr('data-hits-target',obj['hits']).text(obj['hits']);
        });

        //ajax失敗
        jqXHR.fail(function(jqXHR, textStatus, errorThrown){
            // console.log('通信失敗');
            alert('取得に失敗しました、もう一度お試し下さい。');
        });

      }


      /* ==================================================================================
             参考になったボタン
       　================================================================================== */
       $(document).on("click",'[data-reputation-id]', function(){
         var self = this;
         //IDの取得
         var postId = $(this).attr('data-reputation-id');

         //IDがなかった何もしない
         if(!postId) return false;

         //ボタンの情報取得
         var onBtn = $('[data-reputation-id="' + postId + '"]');

         //targetoの取得
         var onTargetCount = $('[data-reputation-target="' + postId + '"]');

         //activeの場合何もしない
         if(onBtn.hasClass('active')) return false;

         //ajax用dataをセット
         var ajaxData = {
               "action": "ajaxDoReputation",
               "id": postId
         };

         //ajax基本処理
          var jqXHR =  $.ajax(ajaxUrl, {
             "type": "post",
             "data": ajaxData,
             "timeout":  2000
         });

         //ajax成功
         jqXHR.done(function(data, textStatus, jqXHR){
           // console.log('通信成功');
           // console.log(data);

           onTargetCount.text(data);
           //activeのclassを付ける
           onBtn.addClass('active');
         });

         //ajax失敗
         jqXHR.fail(function(jqXHR, textStatus, errorThrown){
             // console.log('通信失敗');
             alert('取得に失敗しました、もう一度お試し下さい。');
          });
       });

       /* ==================================================================================
              診断テスト
        　================================================================================== */
        funcDiagnosisTest();
        function funcDiagnosisTest(){

          $(document).on("click",'[data-diagnosis-id]', function(){
            var self = this;
            //IDの取得
            var diagnosisId = $(self).attr('data-diagnosis-id');

            //nameの取得
            var diagnosisName = $(self).attr('data-diagnosis-name');

            //valueの取得
            var diagnosisValue = $(self).attr('data-diagnosis-value');

            //submitフラグの取得
            var submitFlg = $(self).attr('data-diagnosis-submit');

            //IDがなかった何もしない
            if(!diagnosisId) return false;

            //boxを全部一旦非表示に
            $('[data-diagnosis-box]').hide();

            //次のboxを表示に
            $('[data-diagnosis-box="' + (Number(diagnosisId)+1) + '"]').show();

            //formにセット
            $('#formDiagnosis').find('input[name="' + diagnosisName + '"]').attr('value',diagnosisValue);

            //submitFlgが1の場合送信
            if(submitFlg){
              $('#formDiagnosis').submit();
            }

          });

        }

        /* ==================================================================================
               kousotsuを持ってきたら、最初から高卒を選択
         　================================================================================== */
         if($('input[name="gyoukai"]:radio').length > 0){
           $(document).on("change",'input[name="gakureki"]:radio', function(){
             var self = this;
             var val = $(this).val();
             if(val == 'kousotsu'){
               $('input[name="gyoukai"][value="mikeiken"]:radio').prop('checked', true);
             }
           });
         }

         /* ==================================================================================
                ステップアップフォームの処理
          　================================================================================== */
         if($('.formStepup').length > 0){
             $(document).on('click','[data-stepup-form]',function(){
                 var self = $(this);
                 var type = Number(self.attr('data-stepup-form'));
                 var currentStep = Number(self.attr('data-step'));
                 var nextStep = currentStep+1;

                 $('[data-stepup-box="' + type + '"]').find('.formStepup__panel').eq(currentStep-1).hide();
                 $('[data-stepup-box="' + type + '"]').find('.formStepup__panel').eq(nextStep-1).show();

                 $('[data-stepup-form]').attr('data-step',nextStep);
                 $('[data-stepup-return="' + type + '"]').attr('data-step',nextStep);

                 if(nextStep > 1){
                     $('[data-stepup-box="' + type + '"]').find('.formStepup__next').show();
                 }

                 if(currentStep > 4){
                     $('[data-stepup-box="' + type + '"]').find('.formStepup__result').show();
                     $('[data-stepup-box="' + type + '"]').find('.formStepup__next').hide();
                 }



                 if(nextStep > 2){
                     $('[data-stepup-return="' + type + '"]').show();
                 }

                 //img変更
                 // stepupImg(nextStep);

                 //スクロール
                 // stepupScroll(type);

             });

             $(document).on('click','[data-stepup-return]',function(){
                 var self = $(this);
                 var type = Number(self.attr('data-stepup-return'));
                 var currentStep = Number(self.attr('data-step'));
                 var preStep = currentStep-1;

                 if(currentStep == 1) return false;

                 $('[data-stepup-box="' + type + '"]').find('.formStepup__panel').eq(currentStep-1).hide();
                 $('[data-stepup-box="' + type + '"]').find('.formStepup__panel').eq(preStep-1).show();
                 self.attr('data-step',preStep);
                 $('[data-stepup-form="' + type + '"]').attr('data-step',preStep);



                 if(preStep < 2){
                     $('[data-stepup-form="' + type + '"]').text('診断開始');
                     self.hide();
                 }else if(preStep < 5){
                      $('[data-stepup-result="' + type + '"]').removeClass('formStepup__result-on');
                      $('[data-stepup-form="' + type + '"]').show();
                  }

                 //img変更
                 stepupImg(preStep);

                 //スクロール
                 // stepupScroll(type);
             });

         }

         function stepupImg(num){
             var stepNum = num || 0;

             //img変更
             var stepImg = $('[data-step-img]');
             var imgPath = stepImg.attr('data-step-img');
             stepImg.attr('src',imgPath + stepNum + '.png');

         }

         function stepupScroll(type){
             // var formSelector = $('[data-stepup-box="' + type + '"]').parents('.form-search');
             // $("html,body").animate({scrollTop:formSelector.offset().top});
             // $("html,body").animate({scrollTop:0});
         }


         /* ==================================================================================
                tabの設定
          　================================================================================== */
         let tabs = $('[data-tab]');
         if(tabs.length > 0) {
             //タブボタンの処理
             $(document).on('click','[data-tab-select]',function(){
                 let self = $(this);
                 let tab_selector = self.parents('[data-tab]');
                 let tab_id = tab_selector.attr('data-tab');
                 let select_eq = self.attr('data-tab-select');
                 let tab_class = tab_selector.attr('data-tab-class');
                 let current_tab_class = tab_class + '-current';
                 let panel_selector = $('[data-panel="' + tab_id + '"]');
                 let panel_class = panel_selector.attr('data-panel-class');
                 let current_panel_class = panel_class + '-current';

                 //初期化
                 tab_selector.find('[data-tab-select]').removeClass(current_tab_class);
                 panel_selector.find('.' + panel_class).removeClass(current_panel_class);

                 //
                 tab_selector.find('[data-tab-select="' + select_eq + '"]').addClass(current_tab_class);
                 panel_selector.find('.' + panel_class).eq(select_eq).addClass(current_panel_class);
             });
         }

        /* ==================================================================================
        ダイアログ
        　================================================================================== */
        var dialog_menu = $('#dialogMenu');
        var dialog_mask = $('.dialog__mask');


        $(document).on("click",'#dialogSearch', function(){
            var self = this;

            dialog_menu.show();
            dialog_mask.show();
            $('#targetDialogSearch').show();
        });

        $(document).on("click",'#dialogRanking', function(){
            var self = this;

            dialog_menu.show();
            dialog_mask.show();
            $('#targetDialogRanking').show();
        });

        $(document).on("click",'.dialog__mask', function(){
            var self = this;

            dialog_menu.hide();
            dialog_mask.hide();
            $('.dialog__box').hide();
        });

        $(document).on("click",'.dialog__close', function(){
            var self = this;

            dialog_menu.hide();
            dialog_mask.hide();
            $('.dialog__box').hide();
        });


    /* ==================================================================================
       	口コミ
	　================================================================================== */
     $(document).on("click",'[data-wordmouth-id]', function(){
        let self = $(this);
        let wordmouth_id = self.attr('data-wordmouth-id');
        let target_selector = $('[data-wordmouth-target="' + wordmouth_id + '"]');

        if(target_selector.css('display') == 'none'){
            target_selector.show();
            self.addClass('btnWordMouth-open');
        }else {
            target_selector.hide();
            self.removeClass('btnWordMouth-open');
        }
     });


    /* ==================================================================================
        自動送信
    　================================================================================== */
    $(document).on("change",'#jsAutoSubmit', function(){
        let self = $(this);
        let form_tag = self.parents('form');

        form_tag.submit();
    });
 });
