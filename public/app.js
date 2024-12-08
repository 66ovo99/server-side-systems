import './bootstrap';

// app.js

// 页面加载完成后运行的代码
document.addEventListener('DOMContentLoaded', function() {
  console.log('页面已加载');

  // 绑定所有按钮的点击事件
  const buttons = document.querySelectorAll('button');
  buttons.forEach(button => {
      button.addEventListener('click', function() {
          alert('按钮被点击');
      });
  });

  // 示例的导航链接点击事件
  const navLinks = document.querySelectorAll('header nav a');
  navLinks.forEach(link => {
      link.addEventListener('click', function(event) {
          event.preventDefault(); // 阻止默认的链接跳转
          console.log(`导航到: ${link.textContent}`);
      });
  });
});
