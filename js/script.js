document.addEventListener('DOMContentLoaded', function() {
    
    // 1. İLETİŞİM FORMU KONTROLÜ
    // Kullanıcı formu doldurup gönderdiğinde sayfanın yenilenmesini engelleyip mesaj gösterir.
    const contactForm = document.querySelector('.contact-form');
    
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Sayfanın yenilenmesini durdurur (Test aşaması için)
            
            // Gerçek bir projede burada bir fetch() veya AJAX isteği ile veriler PHP/Node.js'e gönderilir.
            alert('Teşekkürler! Mesajınız Güzel Kardeşler ekibine başarıyla iletildi. En kısa sürede dönüş yapacağız.');
            
            contactForm.reset(); // Formu temizler
        });
    }

    // 2. YUMUŞAK KAYDIRMA (Smooth Scroll)
    // Eğer sayfada # işaretli bir linke tıklanırsa (örneğin ana sayfada menüden) oraya yumuşakça kayar.
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            
            if(target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

});