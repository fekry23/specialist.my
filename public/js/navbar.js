/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/navbar.js ***!
  \********************************/
var menuBtn = document.querySelector(".menu-icon span");
var searchBtn = document.querySelector(".search-icon");
var cancelBtn = document.querySelector(".cancel-icon");
var items = document.querySelector(".nav-items");
var form = document.querySelector("form");
menuBtn.onclick = function () {
  items.classList.add("active");
  menuBtn.classList.add("hide");
  searchBtn.classList.add("hide");
  cancelBtn.classList.add("show");
};
cancelBtn.onclick = function () {
  items.classList.remove("active");
  menuBtn.classList.remove("hide");
  searchBtn.classList.remove("hide");
  cancelBtn.classList.remove("show");
  form.classList.remove("active");
  cancelBtn.style.color = "#ff3d00";
};
searchBtn.onclick = function () {
  form.classList.add("active");
  searchBtn.classList.add("hide");
  cancelBtn.classList.add("show");
};
/******/ })()
;