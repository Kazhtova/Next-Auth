import Image from "next/image";
import Link from "next/link";
import { Suspense } from "react";
import {
  RegisterLink,
  LoginLink,
  LogoutLink,
} from "@kinde-oss/kinde-auth-nextjs/components";
import { getKindeServerSession } from "@kinde-oss/kinde-auth-nextjs/server";

const navLinks = [
  { href: "/", label: "Home" },
  { href: "/posts", label: "Posts" },
];

export default function Header() {
  return (
    <header className="flex justify-between items-center py-4 px-7 border-b border-zinc-200 bg-white">
      <Link href="/">
        <Image
          src="/next.svg"
          alt="Next.js Logo"
          width={394}
          height={80}
          style={{ width: 80, height: "auto" }}
          priority
        />
      </Link>

      <nav className="flex items-center gap-x-5">
        <ul className="flex gap-x-5 text-[14px]">
          {navLinks.map((link) => (
            <li key={link.href}>
              <Link
                href={link.href}
                className="text-zinc-400 hover:text-zinc-900 transition"
              >
                {link.label}
              </Link>
            </li>
          ))}
        </ul>

        <div className="flex gap-x-3 text-[14px]">
          <Suspense
            fallback={
              <div
                className="h-5 w-24 animate-pulse rounded bg-zinc-100"
                aria-hidden="true"
              />
            }
          >
            <AuthLinks />
          </Suspense>
        </div>
      </nav>
    </header>
  );
}

async function AuthLinks() {
  const { isAuthenticated } = getKindeServerSession();
  const isLoggedIn = await isAuthenticated();

  return isLoggedIn ? (
    <LogoutLink className="text-zinc-400 hover:text-zinc-900 transition">
      Log out
    </LogoutLink>
  ) : (
    <>
      <LoginLink className="text-zinc-400 hover:text-zinc-900 transition">
        Sign in
      </LoginLink>
      <RegisterLink className="text-zinc-400 hover:text-zinc-900 transition">
        Sign up
      </RegisterLink>
    </>
  );
}