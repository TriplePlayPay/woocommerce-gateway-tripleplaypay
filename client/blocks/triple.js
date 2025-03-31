!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.sdk=t():e.sdk=t()}(this,(function(){return(()=>{"use strict";var e={d:(t,i)=>{for(var n in i)e.o(i,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:i[n]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t),e.d(t,{default:()=>D});var i="https://tripleplaypay.com/iframe/payment",n="https://tripleplaypay.com/responsive-iframe/payment",o="MISSING_ENV_VAR".APP_API_BASE_URL,r=["credit_card","bank","terminal","swipe","apple_pay","google_pay","crypto"],s=["floating","static"],a="tpp_iframe",l={CHARGE:"charge",SAVE:"save"},c={REQUIRED:"required",DISABLED:"disabled"},u={CHARGE:"charge",AUTHORIZE:"authorize",SUBSCRIPTION:"subscription"},h="required",d=!1;function p(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,n)}return i}function y(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?p(Object(i),!0).forEach((function(t){f(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):p(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}function f(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}function m(e){return m="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},m(e)}var v=function(e,t){return e===u.CHARGE?t:t.filter((function(e){return"credit_card"===e}))},g=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=encodeURIComponent(JSON.stringify(e)),i=btoa(t),n="?params=".concat(i);return n},b=function(e,t,o,r){return o?o.includes("https://")?o:r?"".concat(n.replace("/responsive-iframe","")).concat(o):"".concat(i.replace("/iframe","")).concat(o):r?"".concat(n).concat(t):"".concat(i).concat(t)},k=function e(t,i,n){var o=t[0];if(!i[o]&&t.length>1&&(i[o]={}),1!==t.length)return e(t.slice(1,t.length),i[o],n);i[o]=n},S=function(e){return e>=10?e:"0".concat(e)},P=function(){var e=new Date;return"".concat(e.getFullYear(),"-").concat(S(e.getMonth()+1),"-").concat(S(e.getDate()))},w=function(e,t){var i=!1;for(var n in t)t[n]===e&&(i=!0);return i},O={borderBottom:{custom:{borderLeftStyle:"hidden",borderTopStyle:"hidden",borderRightStyle:"hidden",borderRadius:"0",background:"transparent"},0:"borderWidth",1:"borderStyle",2:"borderColor"}},E=function(e){for(var t=e.key,i=(e.value||"").split(" "),n=O[t],o={},r=0;r<i.length;r++)o[n[r]]=i[r];return n.custom&&"object"===m(n.custom)&&(o=y(y({},o),n.custom)),o},C=function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},i={};for(var n in t)t[n]?O[n]?i=y(y({},i),E({key:n,value:t[n]})):"object"===m(t[n])?i=y(y({},i),{},f({},n,e(t[n]))):i[n]=t[n]:i[n]=t[n];return i};function I(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}const M=function(){function e(t){var i=t.iframe,n=t.messageHandler;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.iframe=i,this.messageHandler=n}var t,i;return t=e,(i=[{key:"send",value:function(e){if(!this.iframe)throw new Error("Iframe is not selected");this.iframe.contentWindow.postMessage(e,"*")}},{key:"subscribe",value:function(){window.onmessage=this.messageHandler}},{key:"unsubscribe",value:function(){window.onmessage=function(){}}}])&&I(t.prototype,i),Object.defineProperty(t,"prototype",{writable:!1}),e}();function T(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,n)}return i}function z(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?T(Object(i),!0).forEach((function(t){B(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):T(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}function A(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function B(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}var j=["charge","subscription","authorize"],_=u.CHARGE,R={terminals:[]},D=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.appKey=t,R.terminals=[],this.laneId=null,this.paymentOptions=[]}var t,i;return t=e,i=[{key:"form",value:function(e){var t=e.url,i=e.containerSelector,n=e.onError,o=void 0===n?function(){}:n,r=e.onSuccess,s=void 0===r?function(){}:r,a=e.onInitialized,l=void 0===a?function(){}:a,c=e.newWindow,u=e.styles,h=e.meta,d=void 0===h?{}:h,p=e.meta_id,y=void 0===p?null:p,f=e.height,m=e.secure_form,v=void 0===m?null:m;t?(this.containerSelector=i,this.url=t,this.newWindow=c,this.onSuccess=s,this.onError=o,this.onInitialized=l,this.styles=C(u||{}),this.meta=d,this.meta_id=y,this.secure_form=v,this.height=f,this.init(),this.newWindow||this.setFormIframeHeight()):console.error("Form url is not provided")}},{key:"setFormIframeHeight",value:function(){var e=this.getIframeElement();if(e&&this.height){var t=parseInt(this.height);e.style.height="".concat(t,"px"),e.style.minHeight="".concat(t,"px")}}},{key:"generatePaymentForm",value:function(e){var t=e.paymentType,i=void 0===t?_:t,n=e.containerSelector,o=e.amount,a=e.onError,p=void 0===a?function(){}:a,y=e.onSuccess,f=void 0===y?function(){}:y,m=e.onInitialized,g=void 0===m?function(){}:m,b=e.newWindow,k=e.styles,S=e.allowTip,O=e.tipValue,E=e.zipMode,I=void 0===E?c.REQUIRED:E,M=e.address,T=e.resize,z=e.payBtnText,A=e.start,B=e.cycles,R=e.interval,D=e.frequency,H=e.trial,N=e.email,W=e.fee,x=e.tokenMode,F=e.savePaymentToken,L=void 0===F||F,V=e.laneId,U=e.paymentOptions,q=void 0===U?v(i,r):U,K=e.meta,Y=void 0===K?{}:K,G=e.meta_id,J=void 0===G?null:G,Q=e.secure_form,Z=void 0===Q?null:Q,X=e.autocomplete,$=void 0===X||X,ee=e.fullName,te=void 0===ee?d:ee,ie=e.billingAddress,ne=void 0===ie?d:ie,oe=e.optIn,re=void 0===oe?d:oe,se=e.emailOption,ae=void 0===se?h:se,le=e.phoneOption,ce=void 0===le?h:le,ue=e.showEmailField,he=e.terms,de=e.labels,pe=void 0===de?s[0]:de,ye=e.description,fe=e.publishableKey,me=e.saveMode,ve=e.isVt,ge=e.isMin,be=e.surcharge,ke=e.isMobileResponsive,Se=void 0!==ke&&ke,Pe=e.fieldClass,we=void 0===Pe?"form-control form-control-sm":Pe,Oe=e.selectFieldClass,Ee=void 0===Oe?"form-select form-select-sm":Oe,Ce=e.isHorizontal,Ie=void 0!==Ce&&Ce,Me=e.hidePaymentDetailsLabel,Te=void 0!==Me&&Me,ze=e.hideSubmitButton,Ae=void 0!==ze&&ze,Be=e.googlePayEnvironment,je=void 0===Be?"PRODUCTION":Be,_e=e.googlePayMerchantId,Re=void 0===_e?"BCR2DN4T4TVMV3JA":_e;if(e.iframeMinHeightPx,this.element)return this;if(!j.includes(i))return console.error("Invalid payment type"),void console.warn("Available values: ".concat(j.join(", ")));if(!Array.isArray(q))return console.error("Invalid payment options type"),void console.warn("Available values: ".concat(r.join(", ")));for(var De=0;De<q.length;De++)if(!r.includes(q[De]))return console.error('Invalid payment options value "'.concat(q[De],'"')),void console.warn("Available values: ".concat(r.join(", ")));x===l.SAVE&&(q.includes("terminal")||q.includes("crypto"))&&console.warn('"save" tokenMode supports only card/bank account payment types');var He=this.validateTerminal();if(!He)throw new Error("Selected terminal doesn't exist");if(this.paymentType=i,this.paymentOptions=v(i,q),!this.paymentOptions.length)throw new Error("No valid payment options specified");if(!w(I,c))throw new Error("Such zipMode option doesn't exist");return pe&&!w(pe,s)&&(console.error("Such labels option doesn't exist"),console.warn("Available options are: ".concat(s.join(", ")))),this.zipMode=I,this.laneId=V,this.allowTip=!!S,this.tipValue=O,this.savePaymentToken=L,this.resize=T,this.payBtnText=z,this.address=M,this.fee=W,this.containerSelector=n,this.amount=o,this.iframe=null,this.onError=p,this.onSuccess=f,this.onInitialized=g,this.element=null,this.styles=C(k||this.styles||{}),i===u.SUBSCRIPTION&&(this.start=A||P()),this.trial=H,this.cycles=B,this.interval=R,this.frequency=D,this.email=N,this.tokenMode=x||!1,this.newWindow=b,this.meta=Y,this.meta_id=Z||J,this.autocomplete=$,this.fullName=te,this.billingAddress=ne,this.optIn=re,this.emailOption=ae,this.phoneOption=ce,this.terms=he,this.isVt=ve,this.surcharge=be,this.isMin=ge,this.showEmailField=ue,this.labels=pe,this.description=ye,this.publishableKey=fe,this.saveMode=me,this.isMobileResponsive=Se,this.fieldClass=we,this.selectFieldClass=Ee,this.isHorizontal=Ie,this.hidePaymentDetailsLabel=Te,this.hideSubmitButton=Ae,this.googlePayEnvironment=je,this.googlePayMerchantId=Re,this.allArgs=arguments[0],this.init(),this}},{key:"crypto",value:function(e){var t=e.containerSelector,i=e.amount,n=e.allowTip,o=e.tipValue,s=e.onError,a=void 0===s?function(){}:s,l=e.onSuccess,c=void 0===l?function(){}:l,u=e.onInitialized,p=void 0===u?function(){}:u,y=e.newWindow,f=e.styles,m=void 0===f?{}:f,v=e.address,g=e.payBtnText,b=e.resize,k=e.fee,S=e.meta,P=void 0===S?{}:S,w=e.meta_id,O=void 0===w?null:w,E=e.secure_form,C=void 0===E?null:E,I=e.fullName,M=void 0!==I&&I,T=e.billingAddress,z=void 0===T?d:T,A=e.optIn,B=void 0===A?d:A,j=e.emailOption,R=void 0===j?h:j,D=e.phoneOption,H=void 0===D?h:D,N=e.terms,W=e.labels,x=e.description,F=_;return this.generatePaymentForm({containerSelector:t,paymentType:F,allowTip:n,tipValue:o,paymentOptions:[r[2]],amount:i,onError:a,onSuccess:c,onInitialized:p,newWindow:y,styles:m,address:v,resize:b,payBtnText:g,fee:k,meta:P,meta_id:O,secure_form:C,fullName:M,billingAddress:z,optIn:B,emailOption:R,phoneOption:H,terms:N,labels:W,description:x,isHorizontal,hidePaymentDetailsLabel,hideSubmitButton,googlePayEnvironment,googlePayMerchantId})}},{key:"getTerminals",value:function(){var e=new XMLHttpRequest;return e.open("get","".concat(o,"/terminal")),e.responseType="json",e.setRequestHeader("Authorization","bearer ".concat(this.appKey)),e.send(),new Promise((function(t,i){e.onload=function(){if(200!=e.status)return i({status:e.status,success:!1});var n=z({},e.response.message||{});delete n.ip;var o=[];for(var r in n){var s=n[r];o.push(s)}R.terminals=o,t(o)},e.onerror=function(){i()}}))}},{key:"validateTerminal",value:function(){var e=this;return!this.laneId||!(R.terminals&&!R.terminals.length)&&!!R.terminals.find((function(t){return t.laneId===e.laneId}))}},{key:"clear",value:function(){this.iframe&&this.messenger.send({action:"clear"}),this.paymentType=null,this.paymentOptions=[],this.iframe=null,this.amount=null,this.transactionId=null,this.ticket=null,this.meta=null,this.onError=null,this.onSuccess=null,this.onInitialized=null,this.start=null,this.trial=null,this.cycles=null,this.interval=null,this.frequency=null,this.email=null,this.tokenMode=!1,this.allowTip=!1,this.tipValue=null,this.zipMode=null,this.newWindow=null,this.element=null,this.containerSelector=null,this.styles=null,R.terminals=[],this.laneId=null,this.address=null,this.resize=null,this.payBtnText=null,this.savePaymentToken=null,this.fee=null,this.meta=null,this.meta_id=null,this.secure_form=null,this.autocomplete=!0,this.fullName=!1,this.billingAddress=!1,this.optIn=!1,this.emailOption=!1,this.phoneOption=!1,this.terms=null,this.labels=null,this.url=null,this.description=null,this.isHorizontal=null,this.hidePaymentDetailsLabel=null,this.hideSubmitButton=null,this.googlePayEnvironment="PRODUCTION",this.googlePayMerchantId="BCR2DN4T4TVMV3JA"}},{key:"init",value:function(){this.newWindow||this.useIframe()}},{key:"getData",value:function(){var e={paymentOptions:this.paymentOptions,paymentType:this.paymentType,amount:this.amount,allowTip:this.allowTip,tipValue:this.tipValue,address:this.address,resize:this.resize,payBtnText:this.payBtnText,savePaymentToken:this.savePaymentToken,start:this.start,cycles:this.cycles,interval:this.interval,frequency:this.frequency,email:this.email,apikey:this.appKey,tokenMode:this.tokenMode,zipMode:this.zipMode,fee:this.fee,meta:this.meta,meta_id:this.secure_form||this.meta_id,source:"iframe",styles:this.styles,autocomplete:this.autocomplete,fullName:this.fullName,billingAddress:this.billingAddress,optIn:this.optIn,emailOption:this.emailOption,phoneOption:this.phoneOption,terms:this.terms,labels:this.labels,description:this.description,publishableKey:this.publishableKey,saveMode:this.saveMode,isVt:this.isVt,surcharge:this.surcharge,isMin:this.isMin,showEmailField:this.showEmailField,isMobileResponsive:this.isMobileResponsive,fieldClass:this.fieldClass,selectFieldClass:this.selectFieldClass,isHorizontal:this.isHorizontal,hidePaymentDetailsLabel:this.hidePaymentDetailsLabel,hideSubmitButton:this.hideSubmitButton,googlePayEnvironment:this.googlePayEnvironment,googlePayMerchantId:this.googlePayMerchantId};return+this.trial&&(e.trial=+this.trial),this.paymentOptions.includes("terminal")&&(e.terminal=this.laneId),e}},{key:"tokenize",value:function(){var e=this;this.newWindow||(this.messenger.send({action:"saveToken"}),window.onmessage=function(t){var i=JSON.parse(t.data||"{}");i.hasOwnProperty("action")&&"success"===i.action?e.onSuccess(i):e.onError(i)})}},{key:"process",value:function(){var e=this;if(this.newWindow){var t=this.getData().isMobileResponsive,i=z(z({},this.getData()),{},{location:window.location.href,newWindow:!0}),n=g(i),o=b(0,n,this.url,t),r=window.open(o,"_blank","left=100,top=100,height=600,width=520,fullscreen=no,location=no,status=no,menubar=no,toolbar=no");window.onmessage=function(t){var i=JSON.parse(t.data||"{}");if(i.status)e.onSuccess(i),r.close();else if("initialized"===(null==i?void 0:i.action)){var n;null===(n=e.onInitialized)||void 0===n||n.call(e)}else e.onError(i)}}}},{key:"processPayment",value:function(){this.process()}},{key:"getDomElement",value:function(){var e=document.querySelector(this.containerSelector);if(!e)throw new Error("Such container doesn't exist");return e}},{key:"getIframeElement",value:function(){var e=document.querySelector("#".concat(a));if(!e)throw new Error("Such iframe doesn't exist");return e}},{key:"useIframe",value:function(){var e=this.getDomElement();this.element=e;var t=this.getData();this.iframe=function(e,t,i,n,o,r){e.innerHTML="";var s=function(e,t,i,n,o){console.log("generateTemplate");var r=document.createElement("iframe");return r.setAttribute("allow","payment"),r.style=function(e){var t,i=(null==e||null===(t=e.allArgs)||void 0===t?void 0:t.iframeMinHeightPx)||390;return"width: 100%; overflow: hidden; min-height: ".concat(i,"px; border: none; max-width: 100vw;")}(o),r.src=b(0,t,i,n),r.id=a,r}(0,g(i),n,o,r);return e.appendChild(s),s}(e,this.appKey,t,this.url,t.isMobileResponsive,this),this.createMessenger()}},{key:"changeIframeSize",value:function(e){var t=e.payload,i=this.getIframeElement();if("number"==typeof t&&t)return i.style.height="".concat(t,"px"),void(i.style.minHeight="".concat(t,"px"));i.style.height="".concat(t?520:390,"px")}},{key:"createMessenger",value:function(){this.messenger=new M({iframe:this.iframe,messageHandler:this.handleIncomingMessage.bind(this)}),this.messenger.subscribe()}},{key:"handleIncomingMessage",value:function(e){var t,i=JSON.parse(e.data||"{}");"initialized"!==i.action?"change-iframe-size"!==i.action?"error"!==i.action?"success"!==i.action||this.onSuccess(i):this.onError(i):this.changeIframeSize(i):null===(t=this.onInitialized)||void 0===t||t.call(this)}},{key:"changeStyleProperties",value:function(e,t){var i=this;return this.styles=this.styles||{},e.split(",").forEach((function(e){k(e.split("."),i.styles,t)})),this}},{key:"primaryColor",value:function(e){return this.changeStyleProperties("button.background,radio.checked.color,radio.checked.borderColor,input.focus.borderColor",e)}},{key:"small",value:function(){return this}},{key:"inputBgColor",value:function(e){return this.changeStyleProperties("input.background",e)}},{key:"inputTextColor",value:function(e){return this.changeStyleProperties("input.color",e)}},{key:"inputBorderColor",value:function(e){return this.changeStyleProperties("input.borderColor",e)}},{key:"inputBorderWidth",value:function(e){return this.changeStyleProperties("input.borderWidth",e)}},{key:"inputHeight",value:function(e){return this.changeStyleProperties("input.height",e)}},{key:"inputFontSize",value:function(e){return this.changeStyleProperties("input.fontSize",e)}},{key:"inputFontWeight",value:function(e){return this.changeStyleProperties("input.fontWeight",e)}},{key:"inputPlaceholderColor",value:function(e){return this.changeStyleProperties("input.placeholder.color",e)}},{key:"inputPlaceholderFontSize",value:function(e){return this.changeStyleProperties("input.placeholder.fontSize",e)}},{key:"inputPlaceholderFontWeight",value:function(e){return this.changeStyleProperties("input.placeholder.fontWeight",e)}},{key:"inputErrorBackground",value:function(e){return this.changeStyleProperties("input.error.background",e)}},{key:"buttonHeight",value:function(e){return this.changeStyleProperties("button.height",e)}},{key:"buttonBackground",value:function(e){return this.changeStyleProperties("button.background",e)}},{key:"buttonBorderRadius",value:function(e){return this.changeStyleProperties("button.borderRadius",e)}},{key:"buttonFontSize",value:function(e){return this.changeStyleProperties("button.fontSize",e)}},{key:"buttonColor",value:function(e){return this.changeStyleProperties("button.color",e)}},{key:"buttonHoverBackground",value:function(e){return this.changeStyleProperties("button.hover.background",e)}},{key:"buttonHoverColor",value:function(e){return this.changeStyleProperties("button.hover.color",e)}},{key:"buttonActiveBackground",value:function(e){return this.changeStyleProperties("button.active.background",e)}},{key:"buttonActiveColor",value:function(e){return this.changeStyleProperties("button.active.color",e)}},{key:"radioFontSize",value:function(e){return this.changeStyleProperties("radio.fontSize",e)}},{key:"radioColor",value:function(e){return this.changeStyleProperties("radio.color",e)}},{key:"radioBorderRadius",value:function(e){return this.changeStyleProperties("radio.borderRadius",e)}},{key:"radioBorderColor",value:function(e){return this.changeStyleProperties("radio.borderColor",e)}},{key:"radioFontWeight",value:function(e){return this.changeStyleProperties("radio.fontWeight",e)}},{key:"radioBackground",value:function(e){return this.changeStyleProperties("radio.background",e)}},{key:"radioCheckedColor",value:function(e){return this.changeStyleProperties("radio.checked.color",e)}},{key:"radioCheckedBackground",value:function(e){return this.changeStyleProperties("radio.checked.background",e)}},{key:"radioCheckedBorderColor",value:function(e){return this.changeStyleProperties("radio.checked.borderColor",e)}},{key:"radioCheckedFontSize",value:function(e){return this.changeStyleProperties("radio.checked.fontSize",e)}},{key:"radioCheckedFontWeight",value:function(e){return this.changeStyleProperties("radio.checked.fontWeight",e)}},{key:"cryptoBackground",value:function(e){return this.changeStyleProperties("cryptoCheck.background",e)}},{key:"cryptoColor",value:function(e){return this.changeStyleProperties("cryptoCheck.color",e)}},{key:"cryptoBorderRadius",value:function(e){return this.changeStyleProperties("cryptoCheck.borderRadius",e)}},{key:"cryptoBorderColor",value:function(e){return this.changeStyleProperties("cryptoCheck.borderColor",e)}},{key:"cryptoFontSize",value:function(e){return this.changeStyleProperties("cryptoCheck.fontSize",e)}},{key:"cryptoFontWeight",value:function(e){return this.changeStyleProperties("cryptoCheck.fontWeight",e)}},{key:"cryptoActiveBackground",value:function(e){return this.changeStyleProperties("cryptoCheck.active.background",e)}},{key:"cryptoHoverColor",value:function(e){return this.changeStyleProperties("cryptoCheck.hover.color",e)}},{key:"cryptoHoverBackground",value:function(e){return this.changeStyleProperties("cryptoCheck.hover.background",e)}},{key:"cryptoHoverBorderColor",value:function(e){return this.changeStyleProperties("cryptoCheck.hover.borderColor",e)}},{key:"cryptoCheckedColor",value:function(e){return this.changeStyleProperties("cryptoCheck.checked.color",e)}},{key:"cryptoCheckedBackground",value:function(e){return this.changeStyleProperties("cryptoCheck.checked.background",e)}},{key:"cryptoCheckedBorderColor",value:function(e){return this.changeStyleProperties("cryptoCheck.checked.borderColor",e)}},{key:"errorColor",value:function(e){return this.changeStyleProperties("input.error.borderColor,input.errorText.color,error.bodyError.color",e)}}],i&&A(t.prototype,i),Object.defineProperty(t,"prototype",{writable:!1}),e}();return B(D,"INTERVAL_ENUM",{DAILY:"daily",WEEKLY:"weekly",MONTHLY:"monthly",YEARLY:"yearly"}),B(D,"PAYMENT_TYPES_ENUM",u),B(D,"ZIP_MODES_ENUM",c),B(D,"TOKEN_MODES_ENUM",l),B(D,"PAYMENT_ENUM",{CARD:"credit_card",BANK:"bank",TERMINAL:"terminal",SWIPE:"swipe",APPLE_PAY:"apple_pay",GOOGLE_PAY:"google_pay"}),window&&!window.Triple&&(window.Triple=D),t})()}));