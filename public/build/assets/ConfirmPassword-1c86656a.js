import{v as m,d,e as c,b as e,u as a,w as r,F as u,o as p,X as f,a as o,n as _,g as w,k as b}from"./app-5ae7d91e.js";import{A as g,_ as h}from"./AuthenticationCardLogo-328a6ebe.js";import{_ as v,a as x}from"./TextInput-ab4d4e10.js";import{_ as y}from"./InputLabel-360605c7.js";import{_ as V}from"./PrimaryButton-f090074d.js";const k=o("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),C=["onSubmit"],$={class:"flex justify-end mt-4"},T={__name:"ConfirmPassword",setup(A){const s=m({password:""}),t=d(null),i=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(B,n)=>(p(),c(u,null,[e(a(f),{title:"Secure Area"}),e(g,null,{logo:r(()=>[e(h)]),default:r(()=>[k,o("form",{onSubmit:b(i,["prevent"])},[o("div",null,[e(y,{for:"password",value:"Password"}),e(v,{id:"password",ref_key:"passwordInput",ref:t,modelValue:a(s).password,"onUpdate:modelValue":n[0]||(n[0]=l=>a(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),e(x,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),o("div",$,[e(V,{class:_(["ml-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,C)]),_:1})],64))}};export{T as default};
