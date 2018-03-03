require('../scss/app.scss');

var OneSignal = window.OneSignal || [];
OneSignal.push(["init", {
    appId: "5374d859-7cf1-4ef6-bd81-997092a056a9",
    safari_web_id: 'web.onesignal.auto.014ea808-90d0-46f9-a566-af81aa1c1278',
    autoRegister: false,
    allowLocalhostAsSecureOrigin: true,
    notifyButton: {
        enable: true,
        size: 'large',
        theme: 'default',
        position: 'bottom-right',
        offset: {
            bottom: '50px',
            right: '15px'
        },
        prenotify: true,
        showCredit: false,
        text: {
            'tip.state.unsubscribed': 'Zasubskrybuj powiadomienia',
            'tip.state.subscribed': "Zapisałeś się na subskrybcję",
            'tip.state.blocked': "Zablokowałeś powiadomienia",
            'message.prenotify': 'Kliknij by zasubskrybować powiadomienia',
            'message.action.subscribed': "Dzięki za subskrybcję!",
            'message.action.resubscribed': "Zapisałeś się na subskrybcję",
            'message.action.unsubscribed': "Nie dostaniesz już powiadomień",
            'dialog.main.title': 'Zarządzaj powiadomieniami',
            'dialog.main.button.subscribe': 'SUBSKRYBUJ',
            'dialog.main.button.unsubscribe': 'ANULUJ SUBSKRYBCJĘ',
            'dialog.blocked.title': 'Odblokuj powiadomienia',
            'dialog.blocked.message': "Postępuj zgodnie z tymi krokami by odblokować powiadomienia:"
        }
    },
    welcomeNotification: {
        "title": "Planer – zorganizuj swoje życie",
        "message": "Dzięki za subskrybcję!\nBędziesz teraz powiadamiany o zastępstwach i może nawet o nowym planie lekcji"
    }
}]);
