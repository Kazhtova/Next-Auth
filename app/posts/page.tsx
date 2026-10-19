import Link from "next/link";
import db from "@/lib/db";
import { createPost } from "@/actions/actions";
import { getKindeServerSession } from "@kinde-oss/kinde-auth-nextjs/server";
import { redirect } from "next/navigation";

export const instant = false;

export default async function PostsPage() {
  // Check autentikasi di server component
  const { isAuthenticated } = getKindeServerSession();
  if (!(await isAuthenticated())) {
    redirect("/api/auth/login");
  }

  const posts = await db.post.findMany();

  return (
    <div className="space-y-12 text-center pt-16">
      <h1 className="text-4xl font-bold md:text-5xl text-gray-800">All Posts</h1>

      <form
        action={createPost}
        className="flex flex-col max-w-[400px] mx-auto gap-y-2 mb-10"
      >
        <input
          type="text"
          name="title"
          placeholder="Title for new post"
          className="border rounded px-3 py-2 text-sm"
          required
        />
        <textarea
          name="content"
          placeholder="Content for new post"
          className="border rounded px-3 py-2 text-sm"
          rows={3}
          required
        />
        <button
          type="submit"
          className="bg-zinc-900 text-white rounded px-3 py-2 text-sm font-medium"
        >
          Submit
        </button>
      </form>

      <ul className="max-w-[400px] mx-auto text-left space-y-3">
        {posts.map((post) => (
          <li key={post.id} className="border-b border-zinc-100 pb-2">
            <Link
              href={`/posts/${post.id}`}
              className="text-lg font-semibold hover:underline"
            >
              {post.title}
            </Link>
          </li>
        ))}
      </ul>
    </div>
  );
}
