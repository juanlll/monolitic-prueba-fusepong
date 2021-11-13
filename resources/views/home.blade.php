@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
        <div class="container" id="list-table"></div>
            <style>

  [draggable] {
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            /* Required to make elements draggable in old WebKit */
            -khtml-user-drag: element;
            -webkit-user-drag: element;
        }

        .wrap {
            display: table;
            table-layout: fixed;
            width: 100%;
            height: 100%;
        }

        .dragBox {
            display: table-cell;
            width: 100%;
            height: 100%;
            border: 1px dotted #bdbdbd;
            /*padding: 10px;*/
        }

        .task {
            position: relative;
            color: #576366;
            margin: 10px 20px;
            -webkit-animation: panel-fade-up 0.4s ease;
            -moz-animation: panel-fade-up 0.4s ease;
            animation: panel-fade-up 0.4s ease;
            -webkit-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.1);
        }

        .modal-overlay {
            background-color: #424242;
            background-color: rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            -webkit-transition: opacity 0.4s;
            transition: opacity 0.4s;
            content: '';
            /*pointer-events: none;*/
            z-index: -1;

        }

        .modal-overlay.active {
            opacity: 1;
            z-index: 2000;
        }

        .task.active {

        }

        .cardMini {
            position: relative;
            opacity: 1;
        }

        .cardMini .header {
            height: 10px;
            width: 100%;
        }

        .cardMini .content {
            background-color: #ffffff;
            padding: 10px;
        }

        .cardFull {
            display: none;
            position: fixed;
            background-color: #ffffff;
            opacity: 0;
            overflow: hidden;
            transition: width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s;
        }

        .task.active .cardFull {
            opacity: 1;
            display: block;
            z-index: 2100;
        }

        .header {
            height: 10px;
            width: 100%;
        }

        .color-green {
            background-color: #00c097;
        }

        .color-red {
            background-color: #ff5e8f;
        }

        .color-yellow {
            background-color: #ffd300;
        }

        .color-grass {
            background-color: #84cd1b;
        }

        /*.color-red {*/
        /*background-color: #F6402C;*/
        /*}*/

        .color-pink {
            background-color: #EB1460;
        }

        .color-purple {
            background-color: #9C1AB1;
        }

        .color-deep_purple {
            background-color: #6633B9;
        }

        .color-indigo {
            background-color: #3D4DB7;
        }

        .color-blue {
            background-color: #1093F5;
        }

        .color-light_blue {
            background-color: #00A6F6;
        }

        .color-cyan {
            background-color: #00BBD5;
        }

        .color-teal {
            background-color: #009687;
        }

        .color-light_green {
            background-color: #88C440;
        }

        .color-lime {
            background-color: #CCDD1E;
        }

        .color-amber {
            background-color: #FFC100;
        }

        .color-orange {
            background-color: #FF9800;
        }

        .color-deep_orange {
            background-color: #FF5505;
        }

        .color-brown {
            background-color: #7A5547;
        }

        .color-grey {
            background-color: #9D9D9D;
        }

        .color-blue_grey {
            background-color: #5E7C8B;
        }

        .color-picker {
            padding: 15px;
            margin: 30px auto;
            max-width: 150px;
            /*height: auto;*/
            -webkit-box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
            -moz-box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
        }

        .color {
            float: left;
            width: 20px;
            height: 20px;
            margin: 5px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            cursor: pointer;
        }

        .color-input {
            float: left;
            width: 30px;
            height: 30px;
            margin: 5px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            cursor: pointer;
        }

        #gal-picker {
            top: -1000px;
            lert: -1000px;
            opacity: 0;
            position: fixed;
            overflow: hidden;
            background-color: #ffffff;
            z-index: 0;
        }

        #gal-picker.active {
            opacity: 1;
            margin: auto auto;
            top: 0;
            lert: 0;
            z-index: 2200;

        }

        .color::after {
            content: '';
            width: 3px;
            height: 6px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            margin: 5px 7px;
            display: none;
        }

        .color:hover {
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -ms-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);;
        }

            </style>
   <script>
     'use strict';
galPicker();
    var originalPosition = null;
    var dragEl, nextEl;
    var args = [].slice.call(document.getElementsByClassName('dragBox'));
    console.log(typeof args);
    [].slice.call(document.getElementsByClassName('dragBox')).forEach(function (itemEl) {
        console.log(itemEl);
        itemEl.ondrop = function () {
            drop(this, event);
        };
        itemEl.ondragover = function () {
            allowDrop(this, event);
        };
        [].slice.call(itemEl.children).forEach(function (taskEl) {
            taskEl.draggable = true;

            taskEl.ondragstart = function () {
                drag(this, event);
            };


        });
    });
    function insertAfter(elem, refElem) {
        return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
    }
    function swipeInfo(event) {
        var x = event.clientX,
            y = event.clientY,
            dx, dy;

        dx = ( x > originalPosition.x ) ? "right" : "left";
        dy = ( y > originalPosition.y ) ? "down" : "up";
        originalPosition = {
            x: event.clientX,
            y: event.clientY
        };
        return {
            direction: {
                x: dx,
                y: dy
            },
            offset: {
                x: x - originalPosition.x,
                y: originalPosition.y - y
            }
        };
    }

    function allowDrop(thisTarget, ev) {
        ev.preventDefault();
        ev.dataTransfer.dropEffect = 'move';
        var target = ev.target;
        var info = swipeInfo(ev);
        var superTarget = (target.parentNode).parentNode;





        if (target && superTarget !== dragEl && superTarget.className == 'task') {
            // Сортируем

            // Сортируем
            if (info.direction.y === "down") {
                console.log("-after");
                insertAfter(dragEl, superTarget);
            }
            if (info.direction.y === "up") {
                console.log(" -before");
                thisTarget.insertBefore(dragEl, superTarget);
            }

          //  thisTarget.insertBefore(dragEl, thisTarget.children[0] !== superTarget && superTarget.nextSibling || superTarget);
        }

    }

    function drag(target, event) {
        dragEl = event.target;
        originalPosition = { // И его первоночальную позицию
            x: event.clientX,
            y: event.clientY
        };
        nextEl = dragEl.nextSibling;
        event.dataTransfer.setData("text", target.id);
    }

    function drop(target, event) {

        var data = event.dataTransfer.getData("text");
        if (event.target !== dragEl && event.target.className == 'dragBox') {
            target.appendChild(document.getElementById(data));
        }
        event.preventDefault();
    }

    var thisTask;
    function expandCard(thisCard) {
        thisTask = thisCard;
        document.querySelector('.modal-overlay').classList.add('active');
        var cardMini = thisCard.querySelector('.cardMini');
        var cardFull = thisCard.querySelector('.cardFull');
        if (thisCard.className !== 'active') {
            thisCard.classList.add("active");
            cardLoc = cardMini.getBoundingClientRect();
            // cardFull.log(cardLoc.left);
            cardFull.style.left = cardLoc.left + 'px';
            cardFull.style.top = cardLoc.top + 'px';
            cardFull.style.width = cardLoc.width + 'px';
            cardFull.style.height = cardLoc.height + 'px';
            //     cardFull.style.backgroundColor = '#cccccc';

            //thisCard.classList.add("active");
            setTimeout(function () {
                var w = window.innerWidth
                    || document.documentElement.clientWidth
                    || document.body.clientWidth;

                var h = window.innerHeight
                    || document.documentElement.clientHeight
                    || document.body.clientHeight;


                //  console.log(h + ' ' + w);
                cardFull.style.width = w * .6 + 'px';
                cardFull.style.height = h * .6 + 'px';
                cardFull.style.left = w * .2 + 'px';
                cardFull.style.top = h * .2 + 'px';


            }, 25);

        }
    }
    var cardLoc;
    window.addEventListener('click', function (event) {
        var cardDetail = document.querySelector(".task.active .cardFull");
        var modal = document.querySelector(".modal-overlay");
        //  console.log(cardDetail);

        //   console.log(cardDetail);
        if (event.target == modal) {
            //  var cardLoc = cardDetail.getBoundingClientRect();

            //                // cardDetail.removeAttribute("st/yle");
            cardDetail.style.left = cardLoc.left + 'px';
            cardDetail.style.top = cardLoc.top + 'px';
            cardDetail.style.width = cardLoc.width + 'px';
            cardDetail.style.height = cardLoc.height + 'px';

            setTimeout(function () {
                //
                document.querySelector('.modal-overlay').classList.remove('active');
                document.querySelector(".task.active").classList.remove('active');
                cardDetail.removeAttribute("style");
                //                    cardDetail.classList.remove("cardDetail");

            }, 300);

        }

    });


    function galPicker() {

        //  "use strict";
        let el;
        let inputEl;
        let colors = ["#f44336", "#e91e63", "#9c27b0", "#673ab7", "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4caf50", "#8bc34a", "#cddc39", "#ffeb3b", "#ffc107", "#ff9800", "#ff5722", "#795548", "#607d8b", "#00c097", "#FF5E8F"];
        document.getElementsByTagName('body')[0].innerHTML += '<div class="color-picker" id="gal-picker"></div>';
        let picker = document.getElementById('gal-picker');
        let i = 0;
        let text = "";

        /**
         * Usage for Example  <input type="hidden" class="gal-color" value="#9c27b0">
         *
         */
        function glaColorInit() {

            let init = document.querySelectorAll('.gal-color');
            let i = 0;

            while (init[i]) {
                let initColor = init[i].getAttribute('value');
                el = document.createElement("div");
                insertAfter(init[i], el);
                el.classList.add('color-input');
                el.setAttribute('style', 'background-color: ' + initColor + ';');
                i++;
            }
        }

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

        glaColorInit();

        while (colors[i]) {
            text += '<div   class="color item" style="background-color:' + colors[i] + ';"></div>';
            i++;
        }

        document.getElementById('gal-picker').innerHTML = text;

        document.addEventListener('click', pickerOpen, false);

        function pickerOpen(event) {

            let theTarget = event.target || event.srcElement;
            pickerClose(theTarget);

            if (theTarget.className === 'color-input') {
                inputEl = theTarget;
                let callElement = theTarget.getBoundingClientRect();
                picker.classList.add("active");
                let b = callElement.bottom;
                let l = callElement.left;
                picker.style.top = b + 10 + 'px';
                picker.style.left = l + 'px';

            }
            //console.log(inputEl);
            if (inputEl) {
                pickerOnClick(event, inputEl);
            }

        }

        function pickerOnClick(event, theTarget) {
            let target = event.target;
            if (target.className === 'color item') {
                console.log(theTarget);
                theTarget.style.backgroundColor = target.style.backgroundColor;
                theTarget.previousElementSibling.value = target.style.backgroundColor;
                console.log(theTarget.style.backgroundColor);
                console.log(theTarget.closest('.cardFull').firstElementChild.style);
                theTarget.closest('.cardFull').firstElementChild.style.backgroundColor = target.style.backgroundColor;
                console.log(thisTask);
                thisTask.querySelector('.cardMini').firstElementChild.style.backgroundColor = target.style.backgroundColor;
                return;
            }
        }

        function pickerClose(theTarget) {
            if (theTarget.className !== 'color-picker active' && theTarget.className !== 'color-input') {
                picker.classList.remove('active');
                // if use drug and drop need to delete position inside the window in view
                picker.removeAttribute("style");
            }
        }
    }

galPicker();
   </script>
        </div>
    </section>
@endsection

