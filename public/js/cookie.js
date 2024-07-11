				// Effacer le cookie de consentement aux cookies pour les tests
                document.cookie = "cookie_consent=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

                // Affiche la modal de consentement aux cookies si le consentement n'a pas été donné
                document.addEventListener('DOMContentLoaded', function () {
                if (!document.cookie.split('; ').find(row => row.startsWith('cookie_consent'))) {
                const cookieModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'));
                cookieModal.show();
                }
                
                document.getElementById('acceptCookies').addEventListener('click', function () {
                document.cookie = "cookie_consent=accepted; path=/; max-age=" + (
                60 * 60 * 24 * 365
                );
                const cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
                });
                
                document.getElementById('declineCookies').addEventListener('click', function () {
                document.cookie = "cookie_consent=declined; path=/; max-age=" + (
                60 * 60 * 24 * 365
                );
                const cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
                });
                
                document.getElementById('continueWithoutAccepting').addEventListener('click', function () {
                document.cookie = "cookie_consent=continued_without_accepting; path=/; max-age=" + (
                60 * 60 * 24 * 365
                );
                const cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
                });
                });