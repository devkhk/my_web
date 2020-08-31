<?php
session_start();
include '../cookie/cookie.php';
include '../cookie/visitor.php';
 ?>

<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="utf-8">
    <title>KHK_ABOUTME</title>
    <link rel="stylesheet" href="./css/aboutme.css">
    <link rel="stylesheet" href="./css/skill.css">
  </head>
  <body>
    <nav>
    <div class="container">
      <div class="grid">
        <div class="column-xs-12 column-md-8">
          <p id="logo">ABOUT KHK</p>
        </div>
        <div class="column-xs-12 column-md-4">
          <ul>
            <li><a href="../home/whoru.php">Home</a></li>
            <li><a href="../blog/blog.php">Blog</a></li>
            <li><a href="../timeLine/timeline.php">Timeline</a></li>
            <li><a href="../contect/contect.php">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <main class="about">
    <div class="container">
      <section class="grid info">
        <div class="column-xs-12 column-md-1">
          <div class="about">
          <h1 class="section-heading">About Me</h1>
          </div>
        </div>
        <div class="column-xs-12 column-md-4">
          <img src="./images/left.jpeg">
        </div>
        <div class="column-xs-12 column-md-7">
          <div class="intro">
            <h2>안녕하세요.</h2>
            <h2>개발자 김광현입니다.</h2>
            <p>저는 Full-Stek 개발 공부를 하고 있습니다.</p>
            <p>그래서 프론트와 백엔드를 이해하고 있기때문에 원할한 커뮤니케이션이 장점이 될 수 있습니다.</p>
            <p>저는 프로그래밍의 무궁무진한 가능성에 흥미를 가지고 공부를 시작하게 됐습니다. java와 php, python을 다룰 수 있으며, 백엔드와 데이터 엔지니어링에 관심이 있습니다.</p>
            <p>여러 언어를 금방 이해해 적용하며 빠르게 변화하는 개발 환경에서 빠르게 적응할 수 있는 장점이 있습니다.</p>
          </div>
        </div>
        <div class="column-xs-12 column-md-7">
          <blockquote>
            <div class="skills-background">
              <div class="skills">
      <ul class="lines">
        <li class="line l--0">
          <span class="line__label title">
            Skill level:
          </span>
        </li>
        <li class="line l--25">
          <span class="line__label">
            The basics
          </span>
        </li>
        <li class="line l--50">
          <span class="line__label">
            Advanced
          </span>
        </li>
        <li class="line l--75">
          <span class="line__label">
            Seasoned
          </span>
        </li>
        <li class="line l--100">
          <span class="line__label">
            Expert
          </span>
        </li>
      </ul>

      <div class="charts">
        <div class="chart chart--dev">
          <span class="chart__title">Language</span>
          <ul class="chart--horiz">
            <li class="chart__bar" style="width: 50%;">
              <span class="chart__label">
                Java
              </span>
            </li>
            <li class="chart__bar" style="width: 40%;">
              <span class="chart__label">
                PHP
              </span>
            </li>
            <li class="chart__bar" style="width: 40%;">
              <span class="chart__label">
                Python
              </span>
            </li>
            <li class="chart__bar" style="width: 70%;">
              <span class="chart__label">
                HTML5
              </span>
            </li>
            <li class="chart__bar" style="width: 40%;">
              <span class="chart__label">
                CSS3
              </span>
            </li>
            <li class="chart__bar" style="width: 35%;">
              <span class="chart__label">
                JavaScript
              </span>
            </li>
            <li class="chart__bar" style="width: 35%;">
              <span class="chart__label">
                jQuery
              </span>
            </li>
          </ul>
        </div>

        <div class="chart chart--prod">
          <span class="chart__title">Platform</span>
          <ul class="chart--horiz">
          <li class="chart__bar" style="width: 30%;">
            <span class="chart__label">
              Android
            </span>
          </li>
          <li class="chart__bar" style="width: 45%;">
            <span class="chart__label">
              Linux
            </span>
          </li>
        </ul>
        </div>

        <div class="chart chart--design">
          <span class="chart__title">Sever&Database</span>
          <ul class="chart--horiz">
          <li class="chart__bar" style="width: 40%;">
            <span class="chart__label">
              Mysql8
            </span>
          </li>
          <li class="chart__bar" style="width: 40%;">
            <span class="chart__label">
              Apache
            </span>
          </li>
        </ul>
        </div>
      </div>
    </div>
            </div>
          </blockquote>
        </div>
        <div class="column-xs-12 column-md-5">
          <img src="./images/right.jpeg">
        </div>
      </section>
    </div>
  </main>
  <footer>
    <div class="container">
      <section class="grid">
        <div class="column-xs-12">
          <p class="copyright">&copy; Copyright Design by 2018 Katherine Kato</p>
        </div>
      </section>
    </div>
  </footer>
  </body>
</html>
