// localStorage.setItem('isSignIn', 0);


// KIỂM TRA TÀI KHOẢN
function isUserValid(un, pw) {
    if (un == '' && pw == '') {
        localStorage.setItem('isSignIn', 1);
        return true;
    }
    return false;
}

function signIn2() {
    if (isUserValid('','')) {
        quitModal();
        document.getElementsByClassName('sign-in')[0].style.display = 'block';
        document.getElementsByClassName('sign-out')[0].style.display = 'none';
    }
}

// ĐĂNG XUẤT
function signOut() {
    document.getElementsByClassName('sign-in')[0].style.display = 'none';
    document.getElementsByClassName('sign-out')[0].style.display = 'block';
    localStorage.setItem('isSignIn', 0);
}

// KIỂM TRA ĐĂNG NHẬP
function checkUser() {
    if (localStorage.getItem('isSignIn') == 1) {
        signIn2();
    }
    else {
        signOut();
    }
}

// CHUYỂN ĐĂNG NHẬP -> ĐĂNG KÝ, ĐĂNG KÝ -> ĐĂNG NHẬP
function switchToSignUp() {
    document.getElementById('sign-in').classList.remove('active');
    document.getElementById('sign-up').classList.add('active');
}

function switchToSignIn() {
    document.getElementById('sign-up').classList.remove('active');
    document.getElementById('sign-in').classList.add('active');
}

// THOÁT MODAL
function quitModal() {
    document.getElementById('modal').classList.remove('active');
    document.getElementById('sign-in').classList.remove('active');
    document.getElementById('sign-up').classList.remove('active');
}

// HIỂN THỊ DANH SÁCH HEADER VÀ THANH TÌM KIẾM
function toggleHeader() {
    document.getElementsByClassName('header__toggle')[0].addEventListener('click', function() {
        this.classList.toggle('active');
        document.getElementsByClassName('header__items')[0].classList.toggle('active');
        document.getElementsByClassName('header__search')[0].classList.toggle('active');
    })
}
toggleHeader();