function customSelect() {
    var x, j, l, ll, selElmt, a, b, c;
    x = document.getElementsByClassName('container__wrapper-selection');
    l = x.length;
    for (i = 0 ; i < l ; i++) {
        selElmt = x[i].getElementsByTagName("select")[0];
        ll = selElmt.length;

        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmt.options[selElmt.selectedIndex].innerHTML;
        x[i].appendChild(a);

        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1 ; j < ll ; j++) {
            c = document.createElement("DIV");
            c.innerHTML = selElmt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                var y, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;

                for (i = 0 ; i < sl ; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0 ; k < yl ; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
                if (this.textContent == "Mới nhất" || this.textContent == "Bán chạy" || this.textContent == "Giá giảm dần" || this.textContent == "Giá tăng dần") {
                    if (document.getElementsByClassName('container__wrapper-selection keyboard').length != 0) {
                        sortKeyboards(this.textContent);
                    }
                    if (document.getElementsByClassName('container__wrapper-selection mouse').length != 0) {
                        sortMouses(this.textContent);
                    }
                    if (document.getElementsByClassName('container__wrapper-selection headphone').length != 0) {
                        sortHeadphones(this.textContent);
                    }
                }
                else {
                    if (document.getElementsByClassName('container__wrapper-selection keyboard').length != 0)
                        filterKeyboards(this.textContent);
                    if (document.getElementsByClassName('container__wrapper-selection mouse').length != 0) 
                        filterMouses(this.textContent);
                    if (document.getElementsByClassName('container__wrapper-selection headphone').length != 0) 
                        filterHeadphones(this.textContent);
                }
            }); 
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmt) {
        var y, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0 ; i < yl ; i++) {
            if (elmt == y[i]) {
                arrNo.push(i);
            }
            else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0 ; i < xl ; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
        document.addEventListener("click", closeAllSelect);
    }
} 
customSelect();